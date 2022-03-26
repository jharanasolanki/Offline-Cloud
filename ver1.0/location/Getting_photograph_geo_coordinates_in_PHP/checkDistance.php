<?php

//include 'upload.php';
session_start();
echo "Lat is" . $_SESSION["lat"] ."";


//echo  $latitude['seconds'];
$lat1 = "38.7945";
$lon1 = "6.9158";

// $lat1 = "10.5900627";
// $lon1 = "77.1933317";

$lat2 = "18.9505";
$lon2 = "52.2088";

function distance($lat1, $lon1, $lat2, $lon2, $unit) 
{
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

if(distance($lat1, $lon1, $lat2, $lon2, "K") < 10)
{
  echo "True";
}
else
{
  echo "False";
}
?>