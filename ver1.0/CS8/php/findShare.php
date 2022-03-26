<?php
	include('config.php');
	$username =  $_POST["userMail"];
	$pass =  $_POST["userPass"];
	//$query = "SELECT * FROM shareDetails WHERE username=$username";
	$q="SELECT * FROM shareDetails WHERE username='".$username."'";
	//echo $q;
	$result = mysqli_query($conn,$q);
	if ($result) {
  if (mysqli_num_rows($result) == 0) {
    echo 'No device found!';
  	}
	 else {
        $row = $result->fetch_assoc();
        $uuid=$row["uuid"];
        header("location: ../../../../disk/$uuid");
  }
}
else {
	echo 'Error:';
}