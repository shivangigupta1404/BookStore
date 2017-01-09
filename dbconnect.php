<?php 
define('DB_HOST', 'host here'); 
define('DB_NAME', 'dbname here'); 
define('DB_USER','username here'); 
define('DB_PASSWORD','password here'); 

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
?>