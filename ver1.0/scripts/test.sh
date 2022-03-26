#!/bin/bash
# python3 -m http.server
mkdir /var/www/html/WebUSB/disk/AA9D-0AFE
$command='UUID=AA9D-0AFE /var/www/html/WebUSB/disk/AA9D-0AFE vfat defaults,uid=www-data,gid=www-data,noauto,errors=remount-ro 0 1'  
echo $command >> /etc/fstab 
