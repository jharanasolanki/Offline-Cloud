<?php
$deviceUUID = "AA9D-0AFE";
$deviceFormat ="'vfat";
echo shell_exec('echo "" | sudo -S ./test.sh  2>&1'.$deviceUUID.' '.$deviceFormat);

?>
