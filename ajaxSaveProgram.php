
<?php
//require_once "db.php";
include("config/connect.php");
$bid = mysqli_real_escape_string($con, $_POST['bid']);
$pname = mysqli_real_escape_string($con, $_POST['pname']);
$pname1 = explode('-', $pname);
$pname2 = explode(' ', $pname1[1]);
$nobenefits = mysqli_real_escape_string($con, $_POST['nobenefits']);
$intendbenefits = mysqli_real_escape_string($con, $_POST['intendbenefits']);
$mainid = mysqli_real_escape_string($con, $_POST['mainid']);
$string_keyword = strtolower(implode("_", $pname2));


if (mysqli_query($con, "INSERT INTO responded_program() VALUES('','" . $pname1[0] . "', '" . $nobenefits . "', '" . $intendbenefits . "','" . $mainid . "','" . $string_keyword . "','','2','$bid',CURRENT_TIMESTAMP)")) {
    echo 'Successfully Saved!';
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}

mysqli_close($con);

?>