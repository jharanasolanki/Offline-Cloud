<?php


use movemegif\domain\FileImageCanvas;
use movemegif\GifBuilder;

// just for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include movemegif's namespace
require_once __DIR__ . '/../php/autoloader.php';

// no width and height specified: they will be taken from the first frame
$builder = new GifBuilder();
$builder->setRepeat();

//$myarray = glob("../../lastMonth/*.png");
$myarray = glob("lastMonth/*.png");

$arrlength = count($myarray);

// for($i=0;$i<$arrlength;$i++)
// {
//     //echo $i.'.png';
    
//     rename($myarray[$i],'horse/'.$i.'.png');
// }
for($i=0;$i<$arrlength;$i++)
{
    $myarray[$i] = substr( $myarray[$i], strpos($myarray[$i], "/") + 1);
    $myarray[$i] = strtok($myarray[$i],'/');
    //echo $myarray[$i];
    //echo (__DIR__ .'/horse/'.$myarray[$i]);
    $builder->addFrame()
    ->setCanvas(new FileImageCanvas(__DIR__ .'/lastMonth/'.$myarray[$i]))
    ->setDuration(100);
}
// for ($i = 1; $i <= 3; $i++) {

//     //echo ( '/horse/' . $i . '.png');
//     $builder->addFrame()
//         ->setCanvas(new FileImageCanvas(__DIR__ . '/horse/' . $i . '.png'))
//         ->setDuration(100);
// }
$builder->output('horse.gif');
