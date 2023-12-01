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

$con = mysqli_connect($server,$user,$password,$database) or die('Could not connect: ' . mysql_error());

if(! $con ) {
    die('Could not connect: ' . mysqli_error($conn));
 }
 
?>