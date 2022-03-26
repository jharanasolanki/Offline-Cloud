#!/bin/bash
# python3 -m http.server
$2 = 'dev/sdc1';
$3 = 'B35E-67E1';
mkdir -m 777 /var/www/html/WebUSB/disk/$3
chmod -m 0777 /var/www/html/WebUSB/disk/
mount $2' /var/www/html/WebUSB/disk/B35E-67E1'
