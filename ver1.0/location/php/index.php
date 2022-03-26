<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title> Getting photograph geo coordinates in PHP </title>
</head>
<body>
    
<?php if( isset( $_GET['error'] ) ): ?>
	<!-- Error -->
	<p class="error">
<?php

	switch ($_GET['error']) {
		case 1: 
			echo "Photo not available."; 
		break;
		case 2: 
			echo "Incorrect format."; 
		break;
		case 3: 
			echo " This photo has no geo position data. Try to upload another one."; 
		break;
	}
	
?>
<!-- <p>Upload a jpeg photo.</p>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<input type="file" name="image"> <br>
		<input type='submit' value="Upload!">
	</form> -->	</p>
<?php endif; 
	$myarray = glob("../lastMonth/*.jpg");
	print_r($myarray);
	//echo $myarray[0]['type'];
	?>
</body>
</html>
