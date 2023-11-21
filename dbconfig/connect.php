<?php
require_once __DIR__ .'/../vendor/autoload.php';

try {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
  $dotenv->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
  die('Error loading .env file: '.$e->getMessage());
}

// Rest of your code...

$servername = $_ENV['db_host'];
$user = $_ENV['db_user'];
$pwd = $_ENV['db_password'];
$database = $_ENV['db_database'];

// Create connection
$conn = new mysqli($servername, $user, $pwd, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?> 