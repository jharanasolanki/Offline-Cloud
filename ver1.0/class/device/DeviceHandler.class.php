<?php
/**
 * @author @owner A Lowney, May 2014
 */

include 'StorageDevice.class.php';

function changeDeviceName($newName, $deviceUUID)
{
    $con=new mysqli("db4free.net","codeshastra","codeshastra","codeshastra");
    mysqli_query($con, "update devices set alias = '".$newName."' where deviceUUID = '".$deviceUUID."'");
}

function disassociateDevice($deviceUUID)
{
    $con=new mysqli("db4free.net","codeshastra","codeshastra","codeshastra");
    mysqli_query($con, "update devices set userID = 0 where deviceUUID = '".$deviceUUID."'");
    
}

function associateDevice($userID, $deviceUUID)
{
    $con=new mysqli("db4free.net","codeshastra","codeshastra","codeshastra");
    mysqli_query($con, "update devices set userID = ".$userID." where deviceUUID = '".$deviceUUID."'"); 
}




if(isset($_POST["newName"]) && isset($_POST["deviceUUID"])&& (isset($_POST["userID"]) == FALSE ))
{
    changeDeviceName($_POST["newName"], $_POST["deviceUUID"]);
}
else if(isset($_POST["deviceUUID"]) && (isset($_POST["newName"]) == FALSE )&& (isset($_POST["userID"]) == FALSE ))
{
    disassociateDevice($_POST["deviceUUID"]);
}
else if(isset($_POST["userID"]) && isset($_POST["deviceUUID"]) && (isset($_POST["newName"]) == FALSE))
{
    associateDevice($_POST["userID"], $_POST["deviceUUID"]);
}

else
{

    class DeviceHandler {

        private $con = "";

        public function DeviceHandler()
        { 
            $this->con=new mysqli("db4free.net","codeshastra","codeshastra","codeshastra");
            
        }
        
        public function fetchDevices($userID)
        {
            $this->con=new mysqli("db4free.net","codeshastra","codeshastra","codeshastra");
            $storageDevices = array();
            $storageDevice = new StorageDevice();

            $currentDevices = explode("\n", shell_exec('lsblk')); //attached Storage Devices
            
            $usbStatus = explode("Bus", shell_exec('lsusb')); //attached USB devices

            foreach($usbStatus as $key => $value)
            {     
                $usbStatus[$key] = substr($value, 29);
                if (strpos($value, "Linux") !== false || strpos($value, "HUB") !== false || strpos($value, "Virtual") !== false ||
                        $value == "") 
                {
                    unset($usbStatus[$key]);
                }              
            }

            foreach($currentDevices as $key => $value)
            {   
                /////////////////////////////////////////////////////////
                $currentDevices[$key] = $value;

                if (strpos($value, "sdc") == false && strpos($value, "sdb") == false && strpos($value, "sdd") == false   ) 
                {
                    unset($currentDevices[$key]);
                } 
            }

            $usbStatus = array_values($usbStatus);
            $currentDevices = array_values($currentDevices);
            $allUUIDs = array();

            foreach ($currentDevices as $key => $value)  
            {       

                    //Get path
                    $deviceName = substr($value, strpos($value, "sd"), strpos($value, " "));
                    $devicePath = "/dev/".$deviceName;     

                    //Get UUID
                    // $startUUID = strpos($value, 'UUID="')+6;
                    $device = explode(" ", shell_exec('echo "" | sudo -S blkid udev '.$devicePath));

                    $deviceUUID = $device[3]; 
                    $deviceUUID = substr($deviceUUID, strpos($deviceUUID, "\"")+1, -1);

                    //Get Format
                    $deviceFormat = $device[4];
                    $deviceFormat = substr($deviceFormat, strpos($deviceFormat, "\"")+1, -1);

                    //Set mount path
                    $mountPath = "/var/www/html/WebUSB/disk/".$deviceUUID;
                    $connected = 1;

                    ////Create storage device object 
                    $storageDevice = new StorageDevice();
                    ///////////////////////
                
                    //Search for devices UUID in DB
                    $wasConnected = mysqli_query($this->con, "SELECT deviceUUID FROM devices where deviceUUID = '".$deviceUUID."'");

                    $row = mysqli_fetch_array($wasConnected);
                   
                    if($row[0] == "")//never attached USB device, prior to now
                    { 
                        $sql = "INSERT INTO devices (deviceUUID, userID, alias, mountPath, connected)
                        VALUES ('$deviceUUID', 0, '$devicePath', '$mountPath', '$connected')";

                        $con = $this->con;
                        $con->query($sql);
                        
                        $storageDevice->setUserID(0);// Device is not associated yet as it is new..
                        $storageDevice->setAlias($devicePath);//Device is new so it won't have an alias yet..

                        // $this->fstabAppend($deviceUUID, $deviceFormat);
                        $this->mountDevice($devicePath ,$deviceUUID);
                    }
                    else if($row[0] == $deviceUUID)//USB has been attached previously
                    {
                       $this->mountDevice($devicePath ,$deviceUUID);

                       $result = mysqli_query($this->con, "SELECT * FROM devices where deviceUUID = '".$deviceUUID."'");
                       $row = mysqli_fetch_array($result);
                      
                       $storageDevice->setUserID($row[1]);// Device is not new to the system so we get its userID from the DB 
                                                                //as it might be associated with a user .. 
                       $storageDevice->setAlias($row[2]);

                       mysqli_query($this->con, "update devices set connected = 1 where deviceUUID = '".$deviceUUID."'");
                    }
                    ///////////////////////////////////////////

                    /////////////////Get Device Info/////////////
                    $deviceInfo = explode(" ", shell_exec('echo "" | sudo -S df -H '.$devicePath));

                    $deviceCapacity = $deviceInfo[19];
                    $deviceUsedSpace = $deviceInfo[22];
                    $deviceFreeSpace = $deviceInfo[24];

                    //////////////////////////////////////////
                    //Finish new storageDevice object attributes
                    ////////////////////


                    $storageDevice->setDeviceUUID($deviceUUID);
                    $storageDevice->setCapacity($deviceCapacity);
                    $storageDevice->setFreeSpace($deviceFreeSpace);
                    $storageDevice->setUsedSpace($deviceUsedSpace);
                    $storageDevice->setFormat($deviceFormat);
                    $storageDevice->setConnected($connected);
                    $storageDevice->setMountPath($mountPath);

                    if($storageDevice->getUserID() == $userID || $storageDevice->getUserID() == 0)
                    {
                        array_push($storageDevices, $storageDevice);          
                    }

                    //add UUID to allUUID array so we can later set connected column of non attached devices to 0!
                    array_push($allUUIDs, $deviceUUID); 


            }

            /////////////////////////////////////////////////////////
            //this section gets the set difference of connected and historically connected devices so the connected field can be toggled when an historically connected device is not currently connected!
            /////////////////////////////////////////////////////////
            $allDBDevices = array();

            $result = mysqli_query($this->con, "SELECT deviceUUID FROM devices");

            while($row = mysqli_fetch_array($result))
            {
                array_push($allDBDevices, $row[0]);
            }

            $unconnectedDevices = array_diff($allDBDevices, array_filter($allUUIDs));

            foreach($unconnectedDevices as $key => $value)
            {           
                mysqli_query($this->con, "update devices set connected = 0 where deviceUUID = '".$value."'");  
            } 

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //Get the Database entries for the devies this user has associated with previously but are not attached
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $result = mysqli_query($this->con, "SELECT * FROM devices where userID = ".$userID." and connected = 0");
            
            while($row = mysqli_fetch_array($result))
            {
                $storageDevice = new StorageDevice();
                $storageDevice->setDeviceUUID($row[0]);
                $storageDevice->setUserID($row[1]);
                $storageDevice->setAlias($row[2]);
                $storageDevice->setMountPath($row[3]);
                $storageDevice->setConnected($row[4]);

                array_push($storageDevices, $storageDevice);
            }


            return $storageDevices;
            } 

        // public function fstabAppend($deviceUUID, $deviceFormat)        
        // {
        //     $fstabCommand = 'echo "" | sudo -S ./listDisks.sh fstabAppend '.$deviceUUID.' '.$deviceFormat;
        //     $fstabExec = shell_exec($fstabCommand);     
        // } 

        public function mountDevice($devicePath, $deviceUUID)        
        {
            // $chownDirectory = 'echo "" | sudo -S ./listDisks.sh chownDevice '.'/var/www/html/WebUSB/disk/'.$deviceUUID;
            // $chownExec = shell_exec($chownDirectory);  
             
            $mountCommand = 'echo "" | sudo -S ./listDisks.sh mount '.$devicePath.' '.$deviceUUID;
            $mountExec = shell_exec($mountCommand);     
        }    
  
    }
    

    
}