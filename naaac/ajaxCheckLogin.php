
<?php
    //require_once "db.php";
    include("config/connect.php");

    $uname = htmlspecialchars($_POST['username']);
    //$uname1 = explode(' ',$uname);
    $upass = htmlspecialchars($_POST['userpass']);
    //$upass1 = explode(' ',$upass);
 
    $sql_chkuser = "SELECT * FROM users WHERE username='$uname' AND userpass='$upass'";
    $result = mysqli_query($con, $sql_chkuser);
    if (mysqli_num_rows($result)!=0){
        $_SESSION['userName'] = $uname;
        $_SESSION['userPass'] = $upass;
        header("Location: localhost:8080/naaac/main.php?action=dashboard");
    }else{
       $msg = "Invalid Login";
        //header("Location: localhost:8080/naaac/login.php"); 
       // $msg = 1; 
    }
   
   // mysqli_close($con);
 
?>