<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>NAAAC</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
<?php
$program_id = !isset($_REQUEST['pid']) ?"":htmlspecialchars($_REQUEST['pid']);
$course_id = !isset($_REQUEST['cid']) ?"":htmlspecialchars($_REQUEST['cid']);
$sid = !isset($_REQUEST['sid']) ?"":htmlspecialchars($_REQUEST['sid']);
$sid2 = !isset($_REQUEST['sid2']) ?"":htmlspecialchars($_REQUEST['sid2']);
$tag = !isset($_REQUEST['tag']) ?"":htmlspecialchars($_REQUEST['tag']);

$style="display:none";
$msg_label = "";
$msg_style = "";
$programduration = "";
$starttime = "";
$endtime = "";
$covered_days = "";
$days = "";
$sched_id = "";
$val = array();

if ( $tag=='new' ){ //new record
 // var_dump($_REQUEST);  
 
    if (isset($_POST['submit'])){  

      $programduration = $_POST['programduration'];
      $starttime = $_POST['starttime'];
      $endtime = $_POST['endtime'];
      $program_id = $program_id; 
      $course_id = $course_id;

      if (!empty($_POST['covered_days'])){
        $covered_days_list = $_POST['covered_days'];  
        
        foreach($covered_days_list as $days1)  
          {  
              $days .= $days1.",";  
          }  
      }

      if (strlen($_POST['sid'])==0){
    
        $sql_insert = "INSERT INTO `program_schedule`(program_id,course_id,program_duration,start_time,end_time,days_covered,date_created) 
                        VALUES('$program_id','$course_id','$programduration','$starttime','$endtime','$days',CURRENT_TIMESTAMP)";
          if (mysqli_query($con, $sql_insert)) {
            $sched_id = mysqli_insert_id($con);
            $msg_label =  "Record Save successfully!";
            $msg_style = "bi-star";
            $style = "";
          } else { 
            //$msg_label =  "Error: " . $sql_updateSecC . "<br>" . mysqli_error($con);
            $msg_style = "alert-warning";
            $style = "";
          }               
      }else{
            $msg_label =  "Record Already Exist!";
            $msg_style = "bi-danger";
            $style = "";
      }
}
}


if ($tag == 'edit'){
    
    $sql = "SELECT * FROM `program_schedule` WHERE schedule_id='$sid'";
    $result = mysqli_query($con,$sql);
    
    if (mysqli_num_rows($result) != 0){
      $row = mysqli_fetch_array($result);
      $programduration = $row['program_duration'];
      $starttime = $row['start_time'];
      $endtime = $row['end_time'];
      //$covered_days_list[] = $row['days_covered'];  

          //Explode on comma
            $vals     =   explode(',', $row['days_covered']);
            $count    =   count($vals);
            
            //Trim whitespace
            for($i=0;$i<=$count-1;$i++) {
              $val[]   .=   $vals[$i];
            }
           // echo  $val;

    }  
      //update the record upn submit
      if (isset($_POST['submit'])){
        $covered_days_list = array();
        if (!empty($_POST['covered_days'])){
          $covered_days_list = $_POST['covered_days'];  
          
          foreach($covered_days_list as $days1)  
            {  
                $days .= $days1.",";  
            }  
        }
         
        $programduration = $_POST['programduration'];
        $starttime = $_POST['starttime'];
        $endtime = $_POST['endtime'];

          $sql_update = "UPDATE `program_schedule` SET
          program_duration='$programduration',
          start_time='$starttime',
          end_time='$endtime',
          days_covered='$days',
          date_modified=CURRENT_TIMESTAMP
          WHERE schedule_id='$sid2'";
              if (mysqli_query($con, $sql_update)) {
                $msg_label =  "Record Updated Successfully!";
                $msg_style = "bi-star";
                $style = "";
                } else { 
                //$msg_label =  "Error: " . $sql_updateSecC . "<br>" . mysqli_error($con);
                $msg_style = "alert-warning";
                $style = "";
              }
        }      

}  

?>
  </header><!-- End Header -->

    <div class="pagetitle">
      <h1 align="center"></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="main.php">Home</a></li>
          <li class="breadcrumb-item">Schedule</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style;?>">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
    <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Program : <?php echo selectProgram($_REQUEST['pid']);?></h5>
              <!-- General Form Elements -->
              <form method="post" action="main.php?action=scheduleform">
              
              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Program Duration</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="programduration"><?php echo $programduration ?></textarea>
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputTime" class="col-sm-2 col-form-label">Start Time</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" name="starttime" value="<?php echo $starttime ?>">
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="inputTime" class="col-sm-2 col-form-label">End Time</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" name="endtime" value="<?php echo $endtime ?>">
                  </div>
              </div>
              <div class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Select Covered Days</legend>
                  <?php
                  
                  $str = "";
                  if(isset($_POST['submit'])){
                    
                    if(!empty($_POST['covered_days'])){
                     $choices = $_POST['covered_days'];
                      foreach($choices as $checked){
                       $str = $checked;
                       
                                             
                        ?>
                        
                   <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1"  name="whodoyoutofirst[]" value="<?php echo $str?>" checked>
                      <label class="form-check-label" for="gridCheck1">
                       <?php echo ucwords($str);?>
                      </label>
                    </div> 
                   <?php } 
                   }
                  ?>
                 

                    <?php    
                      //  }
                  }else
                  { ?>

                    <div class="col-sm-10">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="covered_days[]" value="Monday" <?php echo in_array("Monday",$val) ? "checked":"";?>>
                      <label class="form-check-label" for="gridCheck1">
                        Monday
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="covered_days[]" value="Tuesday" <?php echo in_array('Tuesday',$val) ? "checked":"";?>>
                      <label class="form-check-label" for="gridCheck2">
                        Tuesday
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck3" name="covered_days[]" value="Wednesday" <?php echo in_array('Wednesday',$val) ? "checked":"";?>>
                      <label class="form-check-label" for="gridCheck2">
                        Wednesday
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck4" name="covered_days[]" value="Thursday" <?php echo in_array('Thursday',$val) ? "checked":"";?>>
                      <label class="form-check-label" for="gridCheck2">
                        Thursday
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck5" name="covered_days[]" value="Friday" <?php echo in_array('Friday',$val) ? "checked":"";?>>
                      <label class="form-check-label" for="gridCheck2">
                        Friday
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck6" name="covered_days[]" value="Saturday" <?php echo in_array('Saturday',$val) ? "checked":"";?>>
                      <label class="form-check-label" for="gridCheck2">
                        Saturday
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck7" name="covered_days[]" value="Sunday" <?php echo in_array('Sunday',$val) ? "checked":"";?>>
                      <label class="form-check-label" for="gridCheck2">
                        Sunday
                      </label>
                    </div>


                <?php    
                  }      
                  ?>

                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <input type="hidden" name="pid" value="<?php echo $program_id?>">
                    <input type="hidden" name="cid" value="<?php echo $course_id?>">
                    <input type="hidden" name="sid" value="<?php echo $sid?>">
                    <input type="hidden" name="sid2" value="<?php echo $sid?>">
                    <input type="hidden" name="tag" value="<?php echo $tag?>">
                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit Form</button>
                    <a href="main.php?action=schedulelist2&pid=<?php echo $program_id?>&cid=<?php echo $course_id?>"><button type="button" class="btn btn-warning" id="nextpageE">Back</button></a>

                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
    

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
  <script type="text/javascript"> 
  $(function(){
     $('#submit').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
          //alert(val[i]);
            
          if (val[i]=='Monday'){
            $('#gridCheck1').prop('checked');
          }else ifif (val[i]=='Tuesday'){
            $('#gridCheck2').prop('checked');
          } 
        });
      }); 

      

    

    });


</script>
</body>

</html>