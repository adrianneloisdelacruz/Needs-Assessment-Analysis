
<?php
    //require_once "db.php";
    include("config/connect.php");
    $zone = "";
    $cnt = 0;
    $agebracket = "";

    if (isset($_POST['tag']) && $_POST['tag']='checkData'){
        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
        $sql2 = "SELECT ageinlastbirthday FROM assessment_main_info WHERE barangay='$barangay'";
        $rst2 = mysqli_query($con, $sql2);
        if (mysqli_num_rows($rst2)!=0){
            $row2 = mysqli_fetch_array($rst2);
            $age =  $row2['ageinlastbirthday'];  
                if ($age <= 12){
                      $agebracket = "8-12 years of age";  
                }elseif ($age >= 13 && $age <= 19){
                    $agebracket = "13-19 years of age";  
                }elseif ($age >= 20){
                    $agebracket = "20  years old and above";  
                } 
             echo    $agebracket = $agebracket;
        }

    }else{

            $barangay = mysqli_real_escape_string($con, $_POST['barangay_id']);
        
        
            $sql = "SELECT zone FROM barangay WHERE barangay_id='$barangay'";
            $rst = mysqli_query($con, $sql); 

        if (mysqli_num_rows($rst)!=0){
            $row = mysqli_fetch_array($rst);
            $zone =  $row['zone'];

                    $sql2 = "SELECT count(assessment_id) as nowhojoin FROM assessment_main_info WHERE barangay='$barangay'";
                    $rst2 = mysqli_query($con, $sql2);
                    if (mysqli_num_rows($rst2)!=0){
                        $row2 = mysqli_fetch_array($rst2);
                        $cnt =  $row2['nowhojoin'];     
                    }   
                echo $zone."=".$cnt;    
            } else {
            echo "Error: " . $sql . "" . mysqli_error($con);
            }
        }        
    mysqli_close($con);
 
?>