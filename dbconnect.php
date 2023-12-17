<?php 
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'bookstore'); 
define('DB_USER','root'); 
define('DB_PASSWORD',''); 

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
?>