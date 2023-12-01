<?php 
// Include the database config file 
include("config/connect.php");
 
if(!empty($_POST["delete_id"]) && $_POST["tag"] == "delexproject"){ 
    $id = $_POST["delete_id"];

    $sql2 = "SELECT * FROM extension_project WHERE extension_id='$id'";
    $rst2 = mysqli_query($con, $sql2);
     
    if (mysqli_num_rows($rst2)!=0){
        if(mysqli_query($con,"DELETE FROM extension_project WHERE extension_id='$id'")){
            echo 'Record Deleted!';
        } else {
           echo "Error: " . $sql2 . "" . mysqli_error($con);
        }
     
        mysqli_close($con);
   }
}

if(!empty($_POST["delete_id"]) && $_POST["tag"] == "delproject"){ 
    $id = $_POST["delete_id"];

    if(mysqli_query($con,"DELETE FROM project WHERE project_id='$id'")){
        echo 'Record Deleted!';
    } else {
       //echo "Error: " . $sql2 . "" . mysqli_error($con);
    }
 
    mysqli_close($con);
}   

if(!empty($_POST["delete_id"]) && $_POST["tag"] == "delprogram"){ 
    $id = $_POST["delete_id"];

    $sql = "DELETE FROM program WHERE program_id='".$id."'";
    $rst = mysqli_query($con, $sql); 
  
    if (mysqli_query($con, $sql)) {
      echo "Record deleted successfully!";
    } else {
        echo "Error: " . $sql . "" . mysqli_error($con);
     }
  
     mysqli_close($con);
  } 

  if(!empty($_POST["delete_id"]) && $_POST["tag"] == "delbarangay"){ 
    $id = $_POST["delete_id"];
    
    $sql = "DELETE FROM barangay WHERE barangay_id='".$id."'";
    $rst = mysqli_query($con, $sql); 
  
    if (mysqli_query($con, $sql)) {
      echo "Record deleted successfully!";
    } else {
        echo "Error: " . $sql . "" . mysqli_error($con);
     }
  
     mysqli_close($con);
  } 

  if(!empty($_POST["delete_id"]) && $_POST["tag"] == "delschedule"){ 
    $id = $_POST["delete_id"];

    $sql_del = "DELETE FROM `program_schedule` WHERE schedule_id='$id'";
    $result = mysqli_query($con,$sql_del);
  
    if (mysqli_query($con, $sql_del)) {
      $msg_label =  "Record Deleted successfully!";
      $msg_style = "bi-danger";
      $style = "";
    } else { 
      //$msg_label =  "Error: " . $sql_updateSecC . "<br>" . mysqli_error($con);
      $msg_style = "alert-warning";
      $style = "";
    }      
  
  }

  if(!empty($_POST["delete_id"]) && $_POST["tag"] == "deluser"){ 
    $id = $_POST["delete_id"];
    
    $sql_del = "DELETE FROM `users` WHERE user_id='$id'";
    $result = mysqli_query($con,$sql_del);
  
    if (mysqli_query($con, $sql_del)) {
      $msg_label =  "Record Deleted successfully!";
      $msg_style = "bi-danger";
      $style = "";
    } else { 
      //$msg_label =  "Error: " . $sql_updateSecC . "<br>" . mysqli_error($con);
      $msg_style = "alert-warning";
      $style = "";
    }      
  
  }

?>
  