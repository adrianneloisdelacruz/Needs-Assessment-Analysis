<?php 
// Include the database config file 
include("config/connect.php");
 
if(!empty($_REQUEST["barangay_id"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM barangay WHERE barangay_id = ".$_REQUEST['barangay_id']." ORDER BY zone,barangay_name ASC"; 
    $result = mysqli_query($con, $query);
     
    // Generate HTML of state options list 
    if (mysqli_num_rows($result)!=0){
        //echo '<option value="">Select Zone</option>'; 
        while ($row = mysqli_fetch_array($result)) {
            echo '<option value="'.$row['barangay_id'].'">'.$row['zone'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Not available</option>'; 
    } 
}/* elseif(!empty($_POST["state_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM cities WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC"; 
    $result = $db->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select city</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">City not available</option>'; 
    }
} */
?>
  