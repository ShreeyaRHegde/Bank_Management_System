
<?php
session_start();
$host="localhost";
$uid="root";
$pass="";
$db="mybank";

$con=mysqli_connect($host,$uid,$pass,$db);
if(!$con){
	die("Database connection error");
}


?>
