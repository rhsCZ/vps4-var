<?php
header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if(isset($_GET['extended']))
{
    if ($_GET['extended'] == "1")
    {
        $extended = true;
    } else
    {
        $extended = false;
    }
}
if(!isset($_GET['format']))
{
    $_GET['format'] = "raw";
}
switch($_GET['format'])
{
    case "raw":
        header('Content-Type: text/plain; charset=utf-8');
        echo $_SERVER['REMOTE_ADDR'];
        if($extended)
        {
            echo PHP_EOL.@gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        break;
    case "xml":
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
        echo '<query>'.PHP_EOL;
        echo ' <ip>'.$_SERVER['REMOTE_ADDR'].'</ip>'.PHP_EOL;
        if($extended)
        {
            echo '<host>'.@gethostbyaddr($_SERVER['REMOTE_ADDR']).'</host>'.PHP_EOL;
        }
        echo '</query>'.PHP_EOL;
        break;
    case "json":
        header('Content-Type: application/json; charset=utf-8');
        if($extended)
        {  
            echo '{"ip":"'.$_SERVER['REMOTE_ADDR'].'","host":"'.@gethostbyaddr($_SERVER['REMOTE_ADDR']).'"}';  
        } else
        {
            echo '{"ip":"'.$_SERVER['REMOTE_ADDR'].'"}';
        }
        
        break;
    default:
        header('Content-Type: text/plain; charset=utf-8');
        echo $_SERVER['REMOTE_ADDR'];
        if($extended)
        {
            echo PHP_EOL.@gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        break;
}
?>