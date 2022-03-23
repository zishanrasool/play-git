<?php 
// VARIABLES

define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "a8c_test");

// Create connection

$conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die("Connect failed: %s\n". $conn -> error);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

?>