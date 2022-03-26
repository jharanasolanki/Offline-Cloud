<?php
    include("config.php");

    $str=$_GET['q'];// receives username entered by the user
    $sql = "select * from shareDetails where username='$str';";
    $result=$conn->query($sql);
    // If the query returns a row then the username exist
    if($result->num_rows!='0')
    {
        echo "0";
    }
    else
    {
        echo "1";
    }
?>