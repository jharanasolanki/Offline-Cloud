<?php

//include 'index.php';
// We obtain the coordinated of the line
function getCoord( $expr ) {
	$expr_p = explode( '/', $expr );
	return $expr_p[0] / $expr_p[1];
}

// If an image is not uploaded
if( empty( $_FILES['image'] ) ) {
    //if( empty( $myarray[0] ) ) {
	// Redirect to the main with the error
    echo "error ";
	//header( 'Location: /?error=1' );
	exit();
}

// If an image type is not jpeg
if( $_FILES['image']['type'] !== 'image/jpeg' ) {
    //if( substr(strrchr($myarray[0],'.'),1 )!== 'jpg' ) {
	// Redirect to the main with the error
    echo "error 2";
	//header( 'Location: /?error=2' );
	exit();
}

// We use a temporary file path 
$img = $_FILES['image']['tmp_name'];
//$img = $myarray[0];
// We get the data
$exif = exif_read_data( $img, 0, true );

// If there is no GPS branch 
if( empty( $exif['GPS'] ) ) {
    echo "error 3";
    // Redirect to the main with the error
    //header( 'Location: /?error=3' );

    exit();
}

// Latitude
$latitude['degrees'] = getCoord( $exif['GPS']['GPSLatitude'][0] );
$latitude['minutes'] = getCoord( $exif['GPS']['GPSLatitude'][1] );
$latitude['seconds'] = getCoord( $exif['GPS']['GPSLatitude'][2] );

$latitude['minutes'] += 60 * ($latitude['degrees'] - floor($latitude['degrees']));
$latitude['degrees'] = floor($latitude['degrees']);

$latitude['seconds'] += 60 * ($latitude['minutes'] - floor($latitude['minutes']));
$latitude['minutes'] = floor($latitude['minutes']);

// Longitude
$longitude['degrees'] = getCoord( $exif['GPS']['GPSLongitude'][0] );
$longitude['minutes'] = getCoord( $exif['GPS']['GPSLongitude'][1] );
$longitude['seconds'] = getCoord( $exif['GPS']['GPSLongitude'][2] );

$longitude['minutes'] += 60 * ($longitude['degrees'] - floor($longitude['degrees']));
$longitude['degrees'] = floor($longitude['degrees']);

$longitude['seconds'] += 60 * ($longitude['minutes'] - floor($longitude['minutes']));
$longitude['minutes'] = floor($longitude['minutes']);

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Getting photograph geo coordinates in PHP</title>
</head>
<body>
    <h1>Geo coordinates</h1>
    <p>
        Latitude: 
        <?=$exif['GPS']['GPSLatitudeRef'] == 'S' ? '-' : '' ?>
        <?=$latitude['degrees']?><sup>o</sup>
        <?=$latitude['minutes'] ?>'
        <?=$latitude['seconds'] ?>''
        <?php
        session_start();
         $_SESSION["lat1"] =$latitude['seconds']; ?>
    </p>
    
    <p>
        Longitude:
        <?=$exif['GPS']['GPSLongitudeRef'] == 'W' ? '-' : '' ?>
        <?=$longitude['degrees']?><sup>o</sup>
        <?=$longitude['minutes'] ?>'
        <?=$longitude['seconds'] ?>''
        <?php
        session_start();
         $_SESSION["long1"] =$longitude['seconds']; ?>
    </p>
    <?php

/* 
* Given longitude and latitude in North America, return the address using The Google Geocoding API V3
*
*/

function Get_Address_From_Google_Maps($lat, $lon) {

$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false";

// Make the HTTP request
$data = @file_get_contents($url);
// Parse the json response
$jsondata = json_decode($data,true);

// If the json data is invalid, return empty array
if (!check_status($jsondata))   return array();

$address = array(
    'country' => google_getCountry($jsondata),
    'province' => google_getProvince($jsondata),
    'city' => google_getCity($jsondata),
    'street' => google_getStreet($jsondata),
    'postal_code' => google_getPostalCode($jsondata),
    'country_code' => google_getCountryCode($jsondata),
    'formatted_address' => google_getAddress($jsondata),
);

return $address;
}

/* 
* Check if the json data from Google Geo is valid 
*/

function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}

/*
* Given Google Geocode json, return the value in the specified element of the array
*/

function google_getCountry($jsondata) {
    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"]);
}
function google_getProvince($jsondata) {
    return Find_Long_Name_Given_Type("administrative_area_level_1", $jsondata["results"][0]["address_components"], true);
}
function google_getCity($jsondata) {
    return Find_Long_Name_Given_Type("locality", $jsondata["results"][0]["address_components"]);
}
function google_getStreet($jsondata) {
    return Find_Long_Name_Given_Type("street_number", $jsondata["results"][0]["address_components"]) . ' ' . Find_Long_Name_Given_Type("route", $jsondata["results"][0]["address_components"]);
}
function google_getPostalCode($jsondata) {
    return Find_Long_Name_Given_Type("postal_code", $jsondata["results"][0]["address_components"]);
}
function google_getCountryCode($jsondata) {
    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"], true);
}
function google_getAddress($jsondata) {
    return $jsondata["results"][0]["formatted_address"];
}

/*
* Searching in Google Geo json, return the long name given the type. 
* (If short_name is true, return short name)
*/

function Find_Long_Name_Given_Type($type, $array, $short_name = false) {
    foreach( $array as $value) {
        if (in_array($type, $value["types"])) {
            if ($short_name)    
                return $value["short_name"];
            return $value["long_name"];
        }
    }
}

/*
*  Print an array
*/

function d($a) {
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}

    
    <p>
        <a href="https://maps.google.com/maps?q=<?=$exif['GPS']['GPSLatitudeRef'] == 'S' ? '-' : '' ?><?=$latitude['degrees']?>+<?=$latitude['minutes']?>'+<?=$latitude['seconds']?>'',+<?=$exif['GPS']['GPSLongitudeRef'] == 'W' ? '-' : '' ?><?=$longitude['degrees']?>+<?=$longitude['minutes']?>'+<?=$longitude['seconds']?>''" target="_blank">Show on the map</a>
    </p>
    <p>
    <a href = "checkDistance.php">check Distance</a>
</p>
</body>
</html>
