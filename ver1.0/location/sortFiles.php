<?php

// $myarray = glob("*.jpg*");
// usort($myarray, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));


// foreach($myarray as $file){
//     echo $file ."\n";
// }
// echo $myarray[0];

//$folder = ""
$date = [];
$fileName = [];
$i=0;
$myarray = glob("*.jpg*");
foreach($myarray as $file){
    $filename =$file;
    if (file_exists($filename)) {
        $exif = exif_read_data($filename, 0, true);
        foreach ($exif as $key => $section) {
            foreach ($section as $name => $val) {
                if($name == "DateTimeOriginal"){
                    $date[$i] = substr($val,0,10);
                    $fileName[$i] = $file;
                    //echo  $date[$i]."\n" ;
                    $i=$i+1;
                    }
                }
             }
    }
}
$lastWeekendDate = date('y/m/d', strtotime('last Sunday'));
$lastMonth = date('t',strtotime('last month'));
$lastYear = date("Y",strtotime("-1 year"));


$pathToStoreLastWeekend = "animationImg/example/horse/lastWeekend";
$pathToStoreLastMonth = "animationImg/example/horse/lastMonth";
$pathToStoreLastYear = "animationImg/example/horse/lastYear";

$lastMonth = "2022/03/18"; //uncomment later, only for testing

mkdir($pathToStoreLastWeekend);
mkdir($pathToStoreLastMonth);
mkdir($pathToStoreLastYear);
$arrlength = count($date);
for($i=0;$i<$arrlength;$i++)
{
    $date[$i] = str_replace(":","/",$date[$i]);
    if($lastWeekendDate  == $date[$i]){
        $filePath = $fileName[$i];
        $destinationFilePath = $pathToStoreLastWeekend. '/'.$fileName[$i];
        if( !copy($filePath, $destinationFilePath) ) { 
            echo "File can't be copied! \n"; 
        } 
        else { 
            echo "File has been copied! \n"; 
        }
    }
    elseif($lastMonth == $date[$i]){
        $filePath = $fileName[$i];
        $destinationFilePath =  $pathToStoreLastMonth. '/'.$fileName[$i];
        if( !copy($filePath, $destinationFilePath) ) { 
            echo "File can't be copied! \n"; 
        } 
        else { 
            echo "File has been copied! \n"; 
        } 
    }
    elseif($lastYear == $date[$i]){
        $filePath = $fileName[$i];
        $destinationFilePath =  $pathToStoreLastYear. '/'.$fileName[$i];
        if( !copy($filePath, $destinationFilePath) ) { 
            echo "File can't be copied! \n"; 
        } 
        else { 
            echo "File has been copied! \n"; 
        }
    }
}?>
<a href = "animationImg/example/memories.php">Show animation </a>
<?php

/* Store the path of source file */

// /* Store the path of destination file */
// $destinationFilePath = 'copyImages/*.jpeg';
// /* Copy File from images to copyImages folder */
// if( !rename($filePath, $destinationFilePath) ) {  
//     echo "File can't be moved!";  
// }  
// else {  
//     echo "File has been moved!";  
// } 
// $arrlength = count($date);
// foreach($i=0;$i<$arrlength;$i++){
//     if($date[0] == $date[i])
//         echo $date[i];
// }
?>
