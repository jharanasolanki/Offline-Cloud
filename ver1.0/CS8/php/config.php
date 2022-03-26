<?php
session_start();
$servername = "db4free.net";
$username = "codeshastra";
$password = "codeshastra";
$dbname = "codeshastra";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>