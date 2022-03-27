<?php
$str=$_GET['q'];
define("SITE_ROOT", dirname(dirname(__FILE__)));
$url ='http://127.0.0.1:8090/'.SITE_ROOT.$str;
echo $url;

// Use basename() function to return the base name of file
$file_name = basename($url);


/* if (file_put_contents($file_name, file_get_contents($url))) {
    echo "File downloaded successfully";
} else {
    echo "File downloading failed.";
} */
