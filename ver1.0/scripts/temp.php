<?php
$deviceUUID = "EC6C-25EC";
$deviceFormat ="'vfat";
echo shell_exec('echo "" | sudo -S ./test.sh  2>&1'.$deviceUUID.' '.$deviceFormat);

?>
