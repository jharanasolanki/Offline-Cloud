<?php
	include('config.php');
	$username =  $_POST["userMail"];
	$pass =  $_POST["userPass"];
	//$query = "SELECT * FROM shareDetails WHERE username=$username";
	$q="SELECT * FROM shareDetails WHERE username='".$username."'";
	echo $q;
	$result = mysqli_query($conn,$q);
	if ($result) {
  if (mysqli_num_rows($result) > 0) {
    echo 'found!';
  	}
	 else {
	$sql = "INSERT INTO shareDetails VALUES ('$username', '$pass')";
	echo $sql;
	$conn->query($sql);

  }
}
else {
	echo 'Error:';
}
	//$name = $_POST['user_name'];
	//$age = $_POST['user_age'];
    
	//$uid = $_SESSION['user'];

    //echo $name;
    //echo $age;

	// $sql = "SELECT subcost FROM cart WHERE uid='$uid'";
	// $result = $conn->query($sql);
	// $row = $result->fetch_assoc();
	// $sum = 0.0;
	// foreach ($result as $r) {
	// 	echo $r[subcost];
	// 	$sum  += $r[subcost];
	// }
	// $sql = "INSERT INTO bill VALUES ('$uid', '$sum') ON DUPLICATE KEY UPDATE amount = '$sum'";
	// $conn->query($sql);

	//header("Location: cart.php");

?>