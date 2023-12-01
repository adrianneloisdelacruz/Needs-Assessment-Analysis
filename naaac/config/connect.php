<?php
/* $dbhost = "localhost";
$dbname = "needassessment_db";
$dbuser = "root";
$dbpass = "";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Could not connect: ' . mysql_error());
mysql_select_db($dbname) or die('Could not select database');
*/

$user = 'root'; // Mysql
$password = ''; // Mysql Password
$server = 'localhost'; // Mysql Host
$database = 'needassessment_db'; // Mysql Databse
$port = "8080";
//$con = mysqli_connect($server,$user,$password) or die('Could not connect: ' . mysqli_error());
//mysqli_select_db($database) or Die('Could not select Database');

//MySQLi connection with the procedural method and port
//$con = mysqli_connect('$server', '$user', '$password', '$database',3306);

$con=mysqli_connect($server,$user,$password,$database);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit;
}
//
//if(! $con ) {
  //  die('Could not connect: ' . mysqli_error($conn));
 //}

 
?>