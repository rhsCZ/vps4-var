<?php
require_once("function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Verifier</title>
    <link rel="stylesheet" href="dnsq.css">
</head>
<body>
    <header>
        <h1>Verify if domain is blocked</h1>
        <nav>
            <ul>
                <li><a href="./">HomePage</a></li>
                <li><a href="list.php">Active blacklists/whitelists</a></li>
                <li><a href="dnsq.php">Verify if domain is blocked</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php
                /*<div class="response-frame" id="responseFrame">
                <!-- This is where the response will appear -->
            </div>*/
            if(!empty($_REQUEST['domain']))
            {
                echo '<div class="response-frame" id="responseFrame">';
                $domain = $_POST['domain'];
                if(preg_match("/([a-z0-9|-]+\.)*[a-z0-9|-]+\.[a-z]+/",$domain) == 1)
                {
                    $res1 = dns_get_record_from("127.0.0.1","A",$domain);
                    $res2 = dns_get_record_from("127.0.0.1","AAAA",$domain);
                    if($res1[0] == "false" || $res2[0] == "false")
                    {
                        echo '<div style="color: red">something went wrong (probably communication error)!!!</div>';
                    }
                    if(!empty($res2) && $res2[0] != 'false')
                    {
                        $res2 = [inet_ntop(inet_pton($res2[0]))];
                    }
                    if(empty($res1) && empty($res2))
                    {
                        echo '<div style="color: green">Domain '.$domain.' probably doesn\'t exist.</div>';
                    }
                    else if($res1[0] == "0.0.0.0" && $res2[0] == "::")
                    {
                        echo '<div style="color: red">Domain '.$domain.' is blocked on this dns server.</div>';
                    } else
                    {
                        echo '<div style="color: green">Domain '.$domain.' is not blocked.</div>';
                    }
                    //echo "ipv4:".$res1[0]."<br> ipv6:".$res2[0];
                    
                } else
                {
                    echo '<div style="color: red">something went wrong or your input is not valid!!!</div>';
                }
                echo "</div>";
            } 
            ?>
            <form class="centered-form" method="post">
                <label for="inputField">Enter Domain:</label>
                <input type="text" id="domain" name="domain" placeholder="example.com" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 rhsCZ | <a href="mailto:rhs@rhscz.eu">Contact(rhs@rhscz.eu)</a></p>
    </footer>
</body>
</html>