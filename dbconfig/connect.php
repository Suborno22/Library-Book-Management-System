<?php
$servername = "localhost:3306";
$uname = "root";
$pwd = "";
$database = "college";

// Create connection
$conn = new mysqli($servername, $uname,$pwd, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?> 