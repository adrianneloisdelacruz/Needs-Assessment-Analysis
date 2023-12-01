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
//$program_id = !isset($_REQUEST['pid']) ?"":htmlspecialchars($_REQUEST['pid']);
$cid = !isset($_REQUEST['cid']) ? "":htmlspecialchars($_REQUEST['cid']);
$pid = !isset($_REQUEST['pid']) ? "":htmlspecialchars($_REQUEST['pid']); //proj id
$tag = !isset($_REQUEST['tag']) ? "":$_REQUEST['tag']; //
$project_id = !isset($_REQUEST['$project_id']) ? "":htmlspecialchars($_REQUEST['$project_id']);
//$reid = !isset($_REQUEST['reid']) ?"":htmlspecialchars($_REQUEST['reid']);

$style="display:none";
$msg_label = "";
$msg_style = "";
$projecttitle = "";
$projectdesc = "";

$name_community = "";
$college_schoolname = "";
$barangayid = "";
$project_leader = "";
$members = "";
$personel_involved = "";
$date_implemented = "";
$start_date = "";
$end_date = "";
$project_time = "";
$age_bracket = "";
$total_score = "";
$evaluator_name = "";

if (isset($_REQUEST['submit'])){

 $name_community = $_POST['name_community'];
 $college_schoolname = $_POST['college_schoolname'];
 $barangayid = $_POST['barangayid'];
 $project_leader = $_POST['project_leader'];
 $members = $_POST['members'];
 $personel_involved = $_POST['personel_involved'];
 //$date_implemented = $_POST['date_implemented'];
 $start_date = $_POST['start_date'];
 $end_date = $_POST['end_date'];
 $project_time = $_POST['project_time'];
 $age_bracket = $_POST['age_bracket'];
 $total_score = $_POST['total_score'];
 $evaluator_name = $_POST['evaluator_name'];
 $project_title  = "";
 $pid = $_POST['pid'];
 
 // && strlen($project_id)==0
 if (strlen($tag) != 0 && $tag == 'new') {
  
    $sql_insert = "INSERT INTO extension_project(community_name,project_id,college_school_name,barangay,project_leader,members,personel_involved,project_start_date,project_end_date,project_time,age_bracket,total_score,evaluator_name,reference_date) 
                    VALUES('$name_community','$pid','$college_schoolname','$barangayid','$project_leader','$members',' $personel_involved','$start_date','$end_date','$project_time','$age_bracket','$total_score','$evaluator_name',CURRENT_TIMESTAMP)";
    $rst = mysqli_query($con, $sql_insert);       
    
    if (mysqli_query($con, $sql_insert)) {
    
      $project_id = mysqli_insert_id($con);
      $msg_label =  "New Extension record created successfully!";
      $msg_style = "bi-star";
      $style = "";
      } else { 
      $msg_label =  "Error: " . $sql_insert . "<br>" . mysqli_error($con);
      $msg_style = "alert-warning";
      $style = "";
      }
 }
}


if (strlen($tag) != 0 && $tag == 'edit'){
  $eid = $_REQUEST['eid'];

    $sql2 = "SELECT * FROM extension_project WHERE extension_id='$eid'";
    $rst2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($rst2)!=0){  
      $row2 = mysqli_fetch_array($rst2);
      //$project = strtoupper(selectProject($row2['project_id']));
      $name_community = $row2['community_name'];
      //$project_title = $row2['extension_project_title '];
      $actualben = $row2['project_id'];
      $project_leader = $row2['project_leader'];
      $college_schoolname = $row2['college_school_name']; 
      $members = $row2['members'];
      $barangayid =  $row2['barangay'];
      $personel_involved = $row2['personel_involved'];
      $start_date = $row2['project_start_date'];
      $end_date = $row2['project_end_date']; 
      $project_time = $row2['project_time'];
      $age_bracket = $row2['age_bracket'];
      $total_score = $row2['total_score'];
      $evaluator_name = $row2['evaluator_name'];
    }

    if (isset($_POST['submit'])){
      $name_community = $_POST['name_community'];
      $college_schoolname = $_POST['college_schoolname'];
      $barangayid = $_POST['barangayid'];
      $project_leader = $_POST['project_leader'];
      $members = $_POST['members'];
      $personel_involved = $_POST['personel_involved'];
      //$date_implemented = $_POST['date_implemented'];
      $start_date = $_POST['start_date'];
      $end_date = $_POST['end_date'];
      $project_time = $_POST['project_time'];
      $age_bracket = $_POST['age_bracket'];
      $total_score = $_POST['total_score'];
      $evaluator_name = $_POST['evaluator_name'];
   
      $sql_update = "UPDATE extension_project SET community_name='$name_community',college_school_name='$college_schoolname',barangay='$barangayid',project_leader=' $project_leader',members=' $members',
      personel_involved='$personel_involved',project_start_date='$start_date',project_end_date='$end_date',project_time='$project_time ',age_bracket='$age_bracket',
      total_score='$total_score',evaluator_name='$evaluator_name' WHERE extension_id='$eid'";
      $rst = mysqli_query($con, $sql_update);       
    
      if (mysqli_query($con, $sql_update)) {
        
        $msg_label =  "Extension Project record updated successfully!";
        $msg_style = "bi-star";
        $style = "";
        } else { 
        $msg_label =  "Error: " . $sql_update . "<br>" . mysqli_error($con);
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
          <li class="breadcrumb-item">Project</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style?>">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <section class="section">
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Extension Project Title : <?php echo selectProject($pid);?></h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" method="post" action="main.php?action=extensionProject">
                <div class="col-md-12">
                  <label for="inputNameComm" class="form-label">Name Of Community</label>
                  <input type="text" class="form-control" id="inputNameComm" name="name_community" value="<?php echo $name_community ?>" required>
                </div>
                <h8 class="card-title">Implementing College/Agency/Barangay/Sector</h8> 
                <div class="col-md-6">
                  <label for="inputNameSchool" class="form-label">College</label>
                  <input type="text" class="form-control" id="inputNameSchool" name="college_schoolname" value="<?php echo $college_schoolname ?>" required>
                </div>
                <?php  
                  $sql = "SELECT * FROM barangay ORDER BY district,barangay_name";
                  $result = mysqli_query($con,$sql);
                  
                ?>
                <div class="col-md-6">
                  <label for="inputBarangay" class="form-label">Barangay</label>
                  <select id="inputBarangay" class="form-select" name="barangayid" required>
                    <option selected>Choose...</option>
                    <?php  while ($row = mysqli_fetch_array($result)) {
                     $sel = $row['barangay_id'] == $barangayid ? "Selected":"";
                      echo "<option value='" . $row['barangay_id'] . "' $sel>" . strtoupper($row['barangay_name'])."-Zone:".$row['zone'] . "</option>";
                    } ?>
                  </select>
                </div>
                <h8 class="card-title">Proponent's</h8> 
                <div class="col-md-12">
                  <label for="inputNameLeader" class="form-label">Leader</label>
                  <input type="text" class="form-control" id="inputNameLeader" name="project_leader" value="<?php echo $project_leader ?>" required>
                </div>
                <div class="col-md-12">
                  <label for="inputTextarea" class="form-label">Members (List down members name)</label>
                  <div class="col-sm-12">
                    <textarea class="form-control" style="height: 200px" name="members" required><?php echo $members ?></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <label for="inputPersonnel" class="form-label">Personel Involved</label>
                  <input type="text" class="form-control" id="inputPersonnel" name="personel_involved" value="<?php echo $personel_involved ?>" required>
                </div>
                <h8 class="card-title">Project Duration</h8> 
                <!-- <div class="col-md-3">
                  <label for="inputIdate" class="form-label">Project Date Implemented</label>
                  <input type="date" class="form-control" id="inputIdate" name="date_implemented" required>
                </div> -->
                <div class="col-md-4">
                  <label for="inputSdate" class="form-label">Start Date</label>
                  <input type="date" class="form-control" id="inputSdate" name="start_date" value="<?php echo $start_date ?>"  required>
                </div>
                <div class="col-md-4">
                  <label for="inputEdate" class="form-label">End Date</label>
                  <input type="date" class="form-control" id="inputEdate" name="end_date" value="<?php echo $end_date ?>" required>
                </div>
                <div class="col-md-4">
                  <label for="inputPtime" class="form-label">Time</label>
                  <input type="text" class="form-control" id="inputPtime" name="project_time" value="<?php echo $project_time ?>" required>
                </div>
                
                <div class="col-12">
                  <label for="inputAge" class="form-label">Beneficiaries Age Bracket</label>
                  <input type="text" class="form-control" id="inputAge" name="age_bracket" value="<?php echo $age_bracket ?>" required>
                </div>

                <div class="col-md-6">
                  <label for="inputScore" class="form-label">Total Score</label>
                  <input type="text" class="form-control" id="inputScore" name="total_score" value="<?php echo $total_score ?>" required>
                </div>
                <div class="col-md-6">
                  <label for="inputEval" class="form-label">Evaluator's Name</label>
                  <input type="text" class="form-control" id="inputEval" name="evaluator_name" value="<?php echo $evaluator_name ?>" required>
                </div>
                
                <div class="text-center">
                  <input type="hidden" name="pid" value="<?php echo $pid;?>">
                  <input type="hidden" name="project_id" value="<?php echo isset($project_id) ? $project_id:'';?>">
                  <input type="hidden" name="eid" value="<?php echo isset($eid) ? $eid:'';?>">
                  <input type="hidden" name="tag" value="<?php echo $tag;?>"> 
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  <a href="main.php?action=extensionProject2&pid=<?=$pid?>"><button type="button" class="btn btn-warning">Back</button></a>
                </div>
              </form><!-- End Multi Columns Form -->

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
  // ajax script for getting state data
   $(document).on('change','#barangay', function(){
      var barangayID = $(this).val();
      var tag = "checkData";
     // alert(barangayID);
      if(barangayID){
          $.ajax({
              type:'POST',
              url:'ajaxSelect.php',
              data:{'barangay':barangayID,'tag':tag},
              success:function(result){
                //var resArray = result.split("=");
                  $('#agebracket').val(result);
                  //$('#actualben').val(resArray[1]);
                 //alert(result);
              }
          }); 
      }else{
          //$('#state').html('<option value="">Country</option>');
          //$('#city').html('<option value=""> State </option>'); 
      }
  });

</script>
</body>

</html>