<?php
header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$time_start1 = microtime(true);
function checkipv6($address) {
	if(filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
		return true;
	}
	else {
		return false;
	}
}
$ipv6 = checkipv6($_SERVER['REMOTE_ADDR']);
$address  = mm_strip($_SERVER["REMOTE_ADDR"]); 
$port     = mm_strip($_SERVER["REMOTE_PORT"]); 
$method   = mm_strip($_SERVER["REQUEST_METHOD"]); 
$protocol = mm_strip($_SERVER["SERVER_PROTOCOL"]); 
$agent    = mm_strip($_SERVER["HTTP_USER_AGENT"]); 
$host = @gethostbyaddr($address);
$info = get_browser($_SERVER["HTTP_USER_AGENT"],true);
// sanitizes
function mm_strip($string) {
	$string = trim($string); 
	$string = strip_tags($string);
	$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	$string = str_replace("\n", "", $string);
	$string = trim($string); 
	return $string;
}
?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>What's my IP!</title>
		<script type="text/javascript" src="javascript_cookies.js"></script> 
		<script type="text/javascript">
		/*
		Script Name: Your Computer Information
		Author: Harald Hope, Website: http://TechPatterns.com/
		Script Source URI: http://TechPatterns.com/downloads/browser_detection.php
		Version: 1.3.4
		Copyright (C) 2014-02-16

		This program is free software; you can redistribute it and/or modify it under
		the terms of the GNU General Public License as published by the Free Software
		Foundation; either version 3 of the License, or (at your option) any later version.

		This program is distributed in the hope that it will be useful, but WITHOUT
		ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
		FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

		Get the full text of the GPL here: http://www.gnu.org/licenses/gpl.txt

		This script requires the Full Featured Browser Detection and the Javascript Cookies scripts
		to function.
		You can download them here.
		http://TechPatterns.com/downloads/browser_detection_php_ar.txt
		http://TechPatterns.com/downloads/javascript_cookies.txt

		Please note: this version requires the php browser_detection script version 5.4.0 or
		newer.s
		*/

		/*
		If your page is XHMTL 1 strict, you have to
		put this code into a js library file or your
		page will not validate
		*/
		function client_data(info)
		{
			if (info == 'width') {
				width_height_html = '';
				width = (screen.width) ? screen.width:'';
				height = (screen.height) ? screen.height:'';
				// check for windows off standard dpi screen res
				if (typeof(screen.deviceXDPI) == 'number') {
					width *= screen.deviceXDPI/screen.logicalXDPI;
					height *= screen.deviceYDPI/screen.logicalYDPI;
				} 
				width_height_html += '<span>' + width + " x " +
					height + " pixelů</span>";
				(width && height) ? document.write(width_height_html):'';
			}
			else if (info == 'js' ) {
				document.write('<span>JavaScript povolen</span>');
			}
			else if ( info == 'cookies' ) {
				expires ='';
				Set_Cookie( 'cookie_test', 'it_worked' , expires, '', '', '' );
				string = '';
				if ( Get_Cookie( 'cookie_test' ) ) {
					string += '<span>Cookies povoleny</span>';
				}
				else {
					string += '<span>Cookies nepovoleny</span>';
				}
				document.write( string );
				Delete_Cookie( 'cookie_test', '', '')
			}
		}
		</script>
		<style type="text/css">
			* { margin:0; padding:0; }
			body { background:#333; color:#efefef; margin-top:50px;}
			table {text-align: left;}
			.tools { margin:25px auto; width:960px; }
			.tools p {
				margin-left:20px; color:#777; font-family: Georgia,serif;
				-webkit-text-shadow:0 0 7px #000; -moz-text-shadow:0 0 7px #000; text-shadow:0 0 7px #000;
				}
			#ip-lookup { 
				border:1px solid #aaa; 
				background-position:50% 50%; background-repeat:repeat-x; background-color:#777;
				background-image: url(data:image/gif;base64,R0lGODlhAQBWAfcAAHZ2dkVFRXJyck1NTVFRUUVEREpKSnR0dEhISEZGRklJSW1tbVNTU1ZWVnV1dW9vb2lpaUdHR2dnZ2tra0xMTFpaWlBQUFRUVF9fX1VVVFlZWWRkZGBgYEtLS2FhYU5OTl1dXVVVVW5ubnZ1dmpqakZGR2tsbGZmZmJiYnZ1dWNjY0xNTVpbWmxsbFtbW0ZFRkZFRVJSUnBwb15eXlhYWWVlZVdXV05PT09PT1JTUm5vbnNzc3Nyc3BwcHFxcXFwcGppamhoaFhYWF5fXnJxcWhpaWJiY0hISVRUU25tbXV1dmNkY25vb3Rzc1NUU0xLTG1ubnR1dUhHSHV0dGNkZEhHR19eXk5OTXd3dlxdXVdXWHR1dFFRUFxcXU9PUFxbXFdWVlxcXHFxcGFhYmNjYlxdXFhYV3Bvb21sbGNjZGVlZmZmZUxNTFlZWF5dXnBxcFxcW3V2dnR0c1tcW2BfX2JhYlBQUVZXV2hnaFBPT3BxcUhJSElISG5ubXJzc2tqanJzcmZmZ0lKSlhXV1JSUXd2dkdGR2VkZFBQT0tMS2loaGJjY2ZnZmxtbEtLTExMS0lISVtbWkVFRkdGRmRlZGdnaHFxclxbW1FSUUpLSklJSkdHSF9gX2FgYFtaW09OTmtrak9QT1lZWnN0dF5dXVJSU0RFRXN0c2VmZUtMTHNzdGtsa1VVVkRERHd3dwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAABAFYBAAj/AF0JHEiQYCFXABJiSQhgxIg4KUakUOKgYhQHU7Yc2LhxlJxTTVTt2MGDhwA/gASoVGmJiA+Xen6I+fGmRw8ZMs482PmAiQ4dIoJC6ZNkgdEFjdC0aGGi6aoJUCeA+kOCBBCrECAU0QpBUZAgeCpJGCvhBKNAJ9ScWIOqRg1KGw5t2EAljYolKsgYWWQEBYo6KMZ4GNyJg2E6nDAoHmJlyIwZbkCQApEFRJkuYb64gHNpjotInliwqEBalAYNbTTQoCFEiJlBWmzYuAOmge0GrELozsD7gm8GSJwwYJCDeKkYMQgRIIBpOQEuFuxYQGQhj5dQOD7dwHHjg/crA8IPUFgxng2F848cpXqSqIN7AwYywTcgSIF9TfYhIdhzBAEfBFIgUAUCm0RgoCElRFBCAiVMksCDLyQQwAswBACDJAEUEEAApmRYwIethChiiAEBADs=);
		
				-webkit-border-radius:11px; -moz-border-radius:11px; border-radius:11px; 
				-webkit-box-shadow:0 0 11px #111; -moz-box-shadow:0 0 11px #111; box-shadow:0 0 11px #111;
				}
			<?php
			if($ipv6)
			{
				echo '
				#ipv6 {
					color: lime;
				}
				#ipv6-h {
					color: lime;
				}
				#ipv4 {
					color: red;
				}
				#ipv4-h {
					color: red;
				}
				';
			} else
			{
				echo '
				#ipv4 {
					color: lime;
				}
				#ipv4-h {
					color: red;
				}
				';
			}
			?>
			#tools p { font-size:77px; }
			#more p  { font-size:24px; }
			#more-info p { font-size:18px; }
			#more-info ul { margin:20px 0 35px 50px; font-size:18px; color:#ccc; }
			#more-info li { margin:10px 0; line-height:25px; font-family:Helvetica, Arial; }
			h1 { 
				font: 124px/1 Helvetica, Arial; text-align:center; margin:50px 0; color:#efefef;
				-webkit-text-shadow:0 0 7px #333; -moz-text-shadow:0 0 7px #333; text-shadow:0 0 7px #333;
				}
			h1 a:link { color:#efefef; }
			a:link,a:visited { 
				color:#777; text-decoration:none; outline:0 none; 
				-webkit-text-shadow:0 0 7px #000; -moz-text-shadow:0 0 7px #000; text-shadow:0 0 7px #000;
				}
			a:hover,a:active { color:#eee; text-decoration:underline; outline:0 none; }
			li span { 
				font:16px/1 Monaco,"Panic Sans","Lucida Console","Courier New",Courier,monospace,sans-serif; color:#ccc; 
				-webkit-text-shadow:0 0 3px #777; -moz-text-shadow:0 0 3px #777; text-shadow:0 0 3px #777;
				}
		</style>
	</head>
	<body>
		<div id="tools" class="tools">
			<p>Your IP:</p>
		</div>
		<?php
		if($ipv6)
		{
			echo '<div id="ip-lookup" class="tools">
			<h2><span id="ipv6-h">IPv6: </span><span id=ipv6>'.$address.'</span></h2>
			<h3><span id="ipv4-h">IPv4: </span><span id=ipv4>In Progress....</span></h3>
			</div>';
		} else
		{
			echo '<div id="ip-lookup" class="tools">
			<h2><span id="ipv4-h">IPv4: </span><span id=ipv4>'.$address.'</span></h2>
			</div>';
		}
		?>
		<div id="more" class="tools">
			<p><p id="more-link" title="More information">More info</a></p>
		</div>
		<div id="more-info" class="tools">
			<table><th><ul>
			<?php 
				echo '<li><strong>Remote Port:</strong> <span>'.$port.'</span></li>';
				echo '<li><strong>Request Method:</strong> <span>'.$method.'</span></li>';
				echo '<li><strong>Server Protocol:</strong> <span>'.$protocol.'</span></li>';
				if($ipv6)
				{
					echo '<li><strong>IPv6 reverse Hostname:</strong> <span>'.$host.'</span></li>';
					echo '<li><strong>IPv4 reverse Hostname:</strong> <span id="ipv4host">In Progress....</span></li>';
				} else
				{
					echo '<li><strong>IPv4 reverse Hostname:</strong> <span>'.$host.'</span></li>';
				}
				
				echo ''; 

				$time_start = microtime(true);
				usleep(100);
				$time_end = microtime(true);
				$time = $time_end - $time_start;
			?>
			</ul></th>
		<th><ul><?php
					//<li><strong>: </strong><span>'.$info[''].'</span></li>
					echo '
					<li><strong>Operační Systém: </strong><span>'.$info['platform'].'</span></li>
					<li><strong>Prohlížeč: </strong><span>'.$info['comment'].'</span></li>
					<li><strong>Rozlišení: </strong><span><script type="text/javascript">client_data(\'width\');</script></span></li>
					<li><strong>Javascript: </strong><span><script type="text/javascript">client_data(\'js\');</script><noscript>Javascript nepovolen</noscript></span></li>
					<li><strong>Cookies: </strong><span><script type="text/javascript">client_data(\'cookies\');</script></span></li>
					';
		?></ul></th>
		</table>
				<?php echo '<strong>User Agent:</strong> <span>'.$agent.'</span>';?>
			<p><small>It took <?php echo $time; ?> seconds to share this info.</small></p>
		</div>
		<?php
		/*
		<script type="text/javascript">
			function hideStuff(){
				if (document.getElementById){
					var x = document.getElementById('more-info');
					x.style.display="none";
				}
			}
			function toggle(){
				if (document.getElementById){
					var x = document.getElementById('more-info');      
					var y = document.getElementById('more-link');      
					if (x.style.display == "none"){
						x.style.display = "";
						y.innerHTML = "Less info";
					} else {
						x.style.display = "none";
						y.innerHTML = "More info";
					}
				}
			}
			//window.onload = hideStuff;
		</script>*/
		?>
		<?php if($ipv6) echo '<script src="script.js"></script>';
		$time_end1 = microtime(true);
		$time1=$time_end1-$time_start1;
		echo "<span>Total Time:".$time1."</span>";
		?>
	</body>
</html>