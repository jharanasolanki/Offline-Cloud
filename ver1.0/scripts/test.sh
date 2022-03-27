#!/bin/bash
# python3 -m http.server
mkdir -m 777 /var/www/html/WebUSB/disk/ES
chmod 777 /var/www/html/WebUSB/disk/ES
mount /dev/sde1 /var/www/html/WebUSB/disk/ES
