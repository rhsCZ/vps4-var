<?php

$types = [
    1 => 'A',
    28 => 'AAAA'
];

// === 1. Získání DNS dotazu z GET nebo POST ===
$dnsQuery = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['dns'])) {
    $dnsQuery = base64url_decode($_GET['dns']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dnsQuery = file_get_contents('php://input');
}

if (!$dnsQuery) {
    http_response_code(400);
    exit("No DNS query provided.");
}

// === 2. Zjisti doménu a typ ===
list($domain, $qtype) = parseQuery($dnsQuery);
$clientIp = $_SERVER['REMOTE_ADDR'];
$isIPv6 = strpos($clientIp, ':') !== false;

// === 3. Speciální logika pro myip domény ===
$specialDomains = ['myip', 'myip.rhscz'];
$response = null;

if (in_array($domain, $specialDomains)) {
    // Ignorujeme požadovaný typ dotazu – odpovíme podle IP klienta
    $typeName = $isIPv6 ? 'AAAA' : 'A';
    $response = buildDnsResponse($dnsQuery, $typeName, $clientIp);
} else {
    // Přeposlat na lokální DNS
    $response = forwardDnsQuery($dnsQuery);
    if (!$response) {
        http_response_code(504);
        exit("No response from local DNS server.");
    }
}

// === 4. Výstup ===
header("Content-Type: application/dns-message");
echo $response;

// === Pomocné funkce ===

function base64url_decode($data) {
    $data = str_replace(['-', '_'], ['+', '/'], $data);
    return base64_decode(str_pad($data, strlen($data) % 4 === 0 ? strlen($data) : strlen($data) + 4 - strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function parseQuery($data) {
    $offset = 12;
    $labels = [];
    while (true) {
        $len = ord($data[$offset]);
        if ($len === 0) break;
        $offset++;
        $labels[] = substr($data, $offset, $len);
        $offset += $len;
    }
    $offset++;
    $qtype = unpack("n", substr($data, $offset, 2))[1];
    return [strtolower(implode('.', $labels)), $qtype];
}

function forwardDnsQuery($query) {
    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    socket_sendto($sock, $query, strlen($query), 0, '127.0.0.1', 53);
    socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, ["sec" => 2, "usec" => 0]);
    $response = '';
    @socket_recvfrom($sock, $response, 512, 0, $from, $port);
    socket_close($sock);
    return $response;
}

function buildDnsResponse($query, $typeName, $ip) {
    $id = substr($query, 0, 2);
    $flags = "\x81\x80"; // odpověď, bez chyby
    $qdcount = "\x00\x01";
    $ancount = "\x00\x01";
    $nscount = "\x00\x00";
    $arcount = "\x00\x00";
    $header = $id . $flags . $qdcount . $ancount . $nscount . $arcount;

    $questionEnd = strpos($query, "\x00", 12) + 5;
    $question = substr($query, 12, $questionEnd - 12);

    $name = "\xc0\x0c"; // pointer na jméno
    $class = "\x00\x01"; // IN
    $ttl = "\x00\x00\x00\x3c"; // TTL 60

    if ($typeName === 'A') {
        $type = "\x00\x01";
        $rdata = implode('', array_map('chr', explode('.', $ip)));
        $rdlength = "\x00\x04";
    } elseif ($typeName === 'AAAA') {
        $type = "\x00\x1c";
        $rdata = inet_pton($ip);
        $rdlength = pack("n", strlen($rdata));
    } else {
        return null;
    }

    $answer = $name . $type . $class . $ttl . $rdlength . $rdata;
    return $header . $question . $answer;
}
