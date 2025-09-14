<?php
$enabled = true;
$end = "00002905c0000000000000";
function expand($ip){
        $hex = unpack("H*hex", inet_pton($ip));         
        $ip = substr(preg_replace("/([A-f0-9]{4})/", "$1:", $hex['hex']), 0, -1);
        return $ip;
}
#$file = fopen("/var/dns/dns.log", "a+");
if(filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP,FILTER_FLAG_IPV4))
{
        $ipv6 = false;
} else
{
        $ipv6 = true;
}
if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == 'application/dns-message')
{       #fwrite($file,"dns.php: CONTENT_TYPE request");
        $request = file_get_contents("php://input");
        #fwrite($file,"dns.php request: " . $request);
        header("Content-Type: application/dns-message");
        if($ipv6)
        {
                $s = fsockopen("udp://[::1]", 53, $errno, $errstr);
        } else
        {
                $s = fsockopen("udp://127.0.0.1", 53, $errno, $errstr);
        }
        if ($s)
        {
                fwrite($s, $request);
                $read = fread($s, 4096);
                $hex = bin2hex($read);
                $sub1 = substr($hex,26,20);
                if((!strcmp($sub1,"6d79697000001c0001c0") || !strcmp($sub1,"6d7969700000010001c0")) && $enabled)
                {
                        if($ipv6)
                        {
                                $bit = substr($hex, 38, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d7969700000010001c00c001c0001000000000010";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697000001c0001c00c001c0001000000000010";
                                }
                                $ip = expand($_SERVER['REMOTE_ADDR']);
                                $ip2 = str_replace(":", "", $ip);
                                $full = $start . $ip2 . $end;
                                $fullbin = hex2bin($full);
                        } else
                        {
                                $bit = substr($hex, 38, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d7969700000010001c00c00010001000000000004";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697000001c0001c00c00010001000000000004";
                                }
                                $ip = $_SERVER['REMOTE_ADDR'];
                                $ip2 = explode(".", $ip);
                                $full = $start . sprintf("%02X%02X%02X%02X", $ip2[0], $ip2[1], $ip2[2], $ip2[3]) . $end;
                                $fullbin = hex2bin($full);
                        }
                        echo $fullbin;
                } else if(!strcmp($sub1,"6d79697005726873637a") && $enabled)
                {
                        if($ipv6)
                        {
                                $bit = substr($hex, 50, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a0000010001c00c001c0001000000000010";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a00001c0001c00c001c0001000000000010";
                                }
                                $ip = expand($_SERVER['REMOTE_ADDR']);
                                $ip2 = str_replace(":", "", $ip);
                                $full = $start . $ip2 . $end;
                                $fullbin = hex2bin($full);
                        } else
                        {
                                $bit = substr($hex, 50, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a0000010001c00c00010001000000000004";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a00001c0001c00c00010001000000000004";
                                }
                                $ip = $_SERVER['REMOTE_ADDR'];
                                $ip2 = explode(".", $ip);
                                $full = $start . sprintf("%02X%02X%02X%02X", $ip2[0], $ip2[1], $ip2[2], $ip2[3]) . $end;
                                $fullbin = hex2bin($full);
                        }
                        echo $fullbin;
                }
                 else
                {
                        echo $read;
                }
                #fwrite($file, "dns.php response: ".$read);
                fclose($s);
        }
}
else if (isset($_GET['dns']))
{       #fwrite($file,"dns.php: GET request");
        $request = base64_decode(str_replace(array('-', '_'), array('+', '/'), $_GET['dns']));
        #fwrite($file,"dns.php request: " . $request);
        header("Content-Type: application/dns-message");
        if($ipv6)
        {
                $s = fsockopen("udp://[::1]", 53, $errno, $errstr);
        } else
        {
                $s = fsockopen("udp://127.0.0.1", 53, $errno, $errstr);
        }
        if ($s)
        {
                fwrite($s, $request);
                $read = fread($s, 4096);
                $hex = bin2hex($read);
                $sub1 = substr($hex,26,20);
                if((!strcmp($sub1,"6d79697000001c0001c0") || !strcmp($sub1,"6d7969700000010001c0")) && $enabled)
                {
                        if($ipv6)
                        {
                                $bit = substr($hex, 38, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d7969700000010001c00c001c0001000000000010";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697000001c0001c00c001c0001000000000010";
                                }
                                $ip = expand($_SERVER['REMOTE_ADDR']);
                                $ip2 = str_replace(":", "", $ip);
                                $full = $start . $ip2 . $end;
                                $fullbin = hex2bin($full);
                        } else
                        {
                                $bit = substr($hex, 38, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d7969700000010001c00c00010001000000000004";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697000001c0001c00c00010001000000000004";
                                }
                                $ip = $_SERVER['REMOTE_ADDR'];
                                $ip2 = explode(".", $ip);
                                $full = $start . sprintf("%02X%02X%02X%02X", $ip2[0], $ip2[1], $ip2[2], $ip2[3]) . $end;
                                $fullbin = hex2bin($full);
                        }
                        echo $fullbin;
                } else if(!strcmp($sub1,"6d79697005726873637a") && $enabled)
                {
                        if($ipv6)
                        {
                                $bit = substr($hex, 50, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a0000010001c00c001c0001000000000010";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a00001c0001c00c001c0001000000000010";
                                }
                                $ip = expand($_SERVER['REMOTE_ADDR']);
                                $ip2 = str_replace(":", "", $ip);
                                $full = $start . $ip2 . $end;
                                $fullbin = hex2bin($full);
                        } else
                        {
                                $bit = substr($hex, 50, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a0000010001c00c00010001000000000004";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a00001c0001c00c00010001000000000004";
                                }
                                $ip = $_SERVER['REMOTE_ADDR'];
                                $ip2 = explode(".", $ip);
                                $full = $start . sprintf("%02X%02X%02X%02X", $ip2[0], $ip2[1], $ip2[2], $ip2[3]) . $end;
                                $fullbin = hex2bin($full);
                        }
                        echo $fullbin;
                }
                 else
                {
                        echo $read;
                }
                #fwrite($file,"dns.php response: " . $read);
                fclose($s);
        }
} else if(isset($_POST['dns']))
{
        #fwrite($file,"dns.php: POST request");
        $request = base64_decode(str_replace(array('-', '_'), array('+', '/'), $_POST['dns']));
        #fwrite($file,"dns.php request: " . $request);
        header("Content-Type: application/dns-message");
        if($ipv6)
        {
                $s = fsockopen("udp://[::1]", 53, $errno, $errstr);
        } else
        {
                $s = fsockopen("udp://127.0.0.1", 53, $errno, $errstr);
        }
        if ($s)
        {
                fwrite($s, $request);
                $read = fread($s, 4096);
                $hex = bin2hex($read);
                $sub1 = substr($hex,26,20);
                if((!strcmp($sub1,"6d79697000001c0001c0") || !strcmp($sub1,"6d7969700000010001c0")) && $enabled)
                {
                        if($ipv6)
                        {
                                $bit = substr($hex, 38, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d7969700000010001c00c001c0001000000000010";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697000001c0001c00c001c0001000000000010";
                                }
                                $ip = expand($_SERVER['REMOTE_ADDR']);
                                $ip2 = str_replace(":", "", $ip);
                                $full = $start . $ip2 . $end;
                                $fullbin = hex2bin($full);
                        } else
                        {
                                $bit = substr($hex, 38, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d7969700000010001c00c00010001000000000004";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697000001c0001c00c00010001000000000004";
                                }
                                $ip = $_SERVER['REMOTE_ADDR'];
                                $ip2 = explode(".", $ip);
                                $full = $start . sprintf("%02X%02X%02X%02X", $ip2[0], $ip2[1], $ip2[2], $ip2[3]) . $end;
                                $fullbin = hex2bin($full);
                        }
                        echo $fullbin;
                } else if(!strcmp($sub1,"6d79697005726873637a") && $enabled)
                {
                        if($ipv6)
                        {
                                $bit = substr($hex, 50, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a0000010001c00c001c0001000000000010";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a00001c0001c00c001c0001000000000010";
                                }
                                $ip = expand($_SERVER['REMOTE_ADDR']);
                                $ip2 = str_replace(":", "", $ip);
                                $full = $start . $ip2 . $end;
                                $fullbin = hex2bin($full);
                        } else
                        {
                                $bit = substr($hex, 50, 2);
                                if(!strcmp($bit,"01"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a0000010001c00c00010001000000000004";
                                } else if (!strcmp($bit,"1c"))
                                {
                                        $start = "000085800001000100000001046d79697005726873637a00001c0001c00c00010001000000000004";
                                }
                                $ip = $_SERVER['REMOTE_ADDR'];
                                $ip2 = explode(".", $ip);
                                $full = $start . sprintf("%02X%02X%02X%02X", $ip2[0], $ip2[1], $ip2[2], $ip2[3]) . $end;
                                $fullbin = hex2bin($full);
                        }
                        echo $fullbin;
                }
                 else
                {
                        echo $read;
                }
                #fwrite($file,"dns.php response: " . $read);
                fclose($s);
        }
}
#fclose($file);
?>