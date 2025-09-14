<?php
set_time_limit(-25);
include "function.php";
//dns_get_record_from(string $server, string $type, string $record, string $protocol = 'udp')
/*function test(): array
{
    return ['false'];
}
$res = test();
var_dump($res);
*/
try 
{
    $res1 = dns_get_record_from("127.0.0.1","A","expensivefire.com");
} catch (Exception $e)
{
 echo $e;
}
//$res2 = dns_get_record_from("127.0.0.2","AAAA","expensivefire.com");
//$res3 = dns_get_record_from("127.0.0.2","A","ipv4.rhscz.eu");
//$res4 = dns_get_record_from("127.0.0.2","AAAA","ipv4.rhscz.eu");
//$res5 = dns_get_record_from("127.0.0.2","A","mail.rhscz.eu");
//$res6 = dns_get_record_from("127.0.0.2","AAAA","mail.rhscz.eu");
//$res7 = dns_get_record_from("127.0.0.2","A","mailx.rhscz.eu");
//$res8 = dns_get_record_from("127.0.0.2","AAAA","mailx.rhscz.eu");
echo "blokováno:<br>";
var_dump($res1);
echo "<br>";
var_dump($res2);
echo "<br>";
echo "jeden záznam funkční:<br>";
var_dump($res3);
echo "<br>";
var_dump($res4);
echo "<br>";
echo "Oba záznamy funkční:<br>";
var_dump($res5);echo "    ".var_dump(empty($res5));
echo "<br>";
var_dump($res6);echo "    ".var_dump(empty($res6));
echo "<br>";
echo "neexistuje:<br>";
var_dump($res7);echo "    ".var_dump(empty($res7));
echo "<br>";
var_dump($res8);echo "    ".var_dump(empty($res8));
echo "<br>";
?>
