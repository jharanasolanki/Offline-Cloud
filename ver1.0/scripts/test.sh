#!/bin/bash
# python3 -m http.server
$2 = 'dev/sdb1';
$3 = 'AA9D-0AFE';
mkdir -m 777 /var/www/html/WebUSB/disk/$3
chmod -m 0777 /var/www/html/WebUSB/disk/
mount $2' /var/www/html/WebUSB/disk/AA9D-0AFE'
