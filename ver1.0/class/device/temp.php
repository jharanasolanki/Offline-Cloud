<?php

$output = shell_exec('sh ../../script/test.sh');

echo "<pre>" . $output . "</pre>";

?>