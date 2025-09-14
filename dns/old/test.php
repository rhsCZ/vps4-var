<?php
$file = file_get_contents("filters/1.txt");
if($file == false)
{
	echo "false";
} else
{
	/*$parse = yaml_parse($file);
	//echo $parse['filters'];
	foreach ($parse['filters'] as $value) {
		echo $value['url']."<br />";
		//var_dump($value);
		//var_dump($value);
	}*/
	$array = preg_split("/\r\n|\n|\r/", $file);
	var_dump($array);
}
//echo phpversion();
?>