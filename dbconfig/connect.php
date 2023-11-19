<?php
$servername = "localhost:3306";
$user = "root";
$pwd = "";
$database = "college";

// Create connection
$conn = new mysqli($servername, $user,$pwd, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?> 