<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blacklist/Whitelist</title>
    <link rel="stylesheet" href="list.css">
</head>
<body>
    <header>
        <h1>Blacklist/Whitelist</h1>
        <nav>
            <ul>
                <li><a href="./">HomePage</a></li>
                <li><a href="list.php">Active blacklists/whitelists</a></li>
                <li><a href="dnsq.php">Verify if domain is blocked</a></li>
            </ul>
        </nav>
    </header>
    
    <main class="container">
        <div class="table-container">
            <div class="table-wrapper">
                <h2>Blacklists</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Blacklists</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $file = file_get_contents("AdGuardHome.yaml");
                        $parse = yaml_parse($file);
                        foreach ($parse['filters'] as $value) {
                            echo "<tr>
                            <td><a href='".$value['url']."'>".$value['url']."</td>
                            </tr>";
                            //var_dump($value);
                            //var_dump($value);
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="table-wrapper">
                <h2>Whitelists</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Whitelists</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($parse['whitelist_filters'] as $value) {
                            echo "<tr>
                            <td><a href='".$value['url']."'>".$value['url']."</td>
                            </tr>";
                            //var_dump($value);
                            //var_dump($value);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <p>
            <a href="mailto:rhs@rhscz.eu">Contact(rhs@rhscz.eu)</a> | 
            &copy; 2025 rhsCZ
        </p>
    </footer>
</body>
</html>