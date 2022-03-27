<?php
$str=$_GET['q'];
define('SERVER_ROOT', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
$url ="http://localhost/WebUSB/disk/EC6C-25EC/".$str;
echo $url;

// Use basename() function to return the base name of file
$file_name = basename($url);


if (file_put_contents($file_name, file_get_contents($url))) {
    echo "File downloaded successfully";
} else {
    echo "File downloading failed.";
}

$ch = curl_init($url);
  
// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename($url);

// Save file into file location
$save_file_loc = $dir . $file_name;

// Open file
$fp = fopen($save_file_loc, 'wb');

// It set an option for a cURL transfer
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

// Perform a cURL session
curl_exec($ch);

// Closes a cURL session and frees all resources
curl_close($ch);

// Close file
fclose($fp);