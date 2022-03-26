<?php
$path    = "/forpendrive/";
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));
foreach($files as $file){
  echo "<a href='$file'>$file</a>";
}