<?php

include 'index.php';
// We obtain the coordinated of the line
function getCoord( $expr ) {
	$expr_p = explode( '/', $expr );
	return $expr_p[0] / $expr_p[1];
}

// If an image is not uploaded
//if( empty( $_FILES['image'] ) ) {
    if( empty( $myarray[0] ) ) {
	// Redirect to the main with the error
    echo "error ";
	//header( 'Location: /?error=1' );
	exit();
}

// If an image type is not jpeg
//if( $_FILES['image']['type'] !== 'image/jpeg' ) {
    if( substr(strrchr($myarray[0],'.'),1 )!== 'jpg' ) {
	// Redirect to the main with the error
    echo "error 2";
	//header( 'Location: /?error=2' );
	exit();
}

// We use a temporary file path 
//$img = $_FILES['image']['tmp_name'];
$img = $myarray[0];
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
    
    <p>
        <a href="https://maps.google.com/maps?q=<?=$exif['GPS']['GPSLatitudeRef'] == 'S' ? '-' : '' ?><?=$latitude['degrees']?>+<?=$latitude['minutes']?>'+<?=$latitude['seconds']?>'',+<?=$exif['GPS']['GPSLongitudeRef'] == 'W' ? '-' : '' ?><?=$longitude['degrees']?>+<?=$longitude['minutes']?>'+<?=$longitude['seconds']?>''" target="_blank">Show on the map</a>
    </p>
    <p>
    <a href = "checkDistance.php">check Distance</a>
</p>
</body>
</html>
