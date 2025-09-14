<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdGuardHome DNS</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>Welcome to Free Public AdGuardHome DNS Provider</h1>
        <nav>
            <ul>
                <li><a href="./">HomePage</a></li>
                <li><a href="list.php">Active blacklists/whitelists</a></li>
                <li><a href="dnsq.php">Verify if domain is blocked</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="info">
            <h2>Information</h2>
            <p>Hi, Welcome to Free Public AdGuardHome DNS provider. You can see active blacklists/whitelists on page via link on top of the page. 
                You can also verify if domain is blocked via second link.<br>
                There is also available DOT(DNS Over TLS) and DOH(DNS Over HTTPS): tls://<?php echo $_SERVER['HTTP_HOST'];?> and https://<?php echo $_SERVER['HTTP_HOST'];?>/dns-query. 
                If you want add domain to blocklist/whitelist or whole blacklist feel free to open Issue on Github <a href="https://github.com/rhsCZ/adguard-lists">https://github.com/rhsCZ/adguard-lists/</a> or contact me via email on <a href="mailto:rhs@rhscz.eu">rhs@rhscz.eu</a>

                </p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 rhsCZ | <a href="mailto:rhs@rhscz.eu">Contact(rhs@rhscz.eu)</a></p>
    </footer>
</body>
</html>