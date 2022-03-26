#!/bin/sh


if [ $1 = "listUSBs" ];then
	command=`lsusb`
        echo $command   
fi

if [ $1 = "blkid" ];then
	command=`blkid`
        echo $command   
fi

if [ $1 = "fstabAppend" ];then

	echo mkdir /var/www/html/WebUSB/disk$2
        command='UUID='$2'  /var/www/html/WebUSB/disk'$2'  '$3'  defaults,uid=www-data,gid=www-data,noauto,errors=remount-ro 0 1'  
        echo $command >> /etc/fstab           
fi

if [ $1 = "mount" ];then

        mount $2'/var/www/html/WebUSB/disk/'$3
          
fi

if [ $1 = "unmount" ];then
    umount $2;
    
fi

if [ $1 = "info" ];then
        command=`df -H $2`
        echo $command   
fi

if [ $1 = "chownDevice" ];then
        command=`chown -R www-data:www-data $2`
        echo $command   
fi
 
   