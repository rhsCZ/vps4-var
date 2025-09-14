<?php
$file = file_get_contents("AdGuardHome.yaml");
if($file == false)
{
	echo "false";
} else
{
	$parse = yaml_parse($file);
	//echo $parse['filters'];
	foreach ($parse['filters'] as $value) {
		echo $value['url']."<br />";
		//var_dump($value);
		//var_dump($value);
	}
}
//echo phpversion();
?>