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
$cid = !isset($_REQUEST['cid']) ?"":htmlspecialchars($_REQUEST['cid']);
$pid = !isset($_REQUEST['pid']) ?"":htmlspecialchars($_REQUEST['pid']);
$projectid = !isset($_REQUEST['projectid']) ?"":htmlspecialchars($_REQUEST['projectid']);
$style="display:none";
$msg_label = "";
$msg_style = "";
$projecttitle = "";
$projectdesc = "";

$courseid = "";
$barangay = "";
//$projectid = "";
$description = "";
$targetben = "";
$actualben = "";
//$project_id = "";

if (strlen($project_id)!=0){
  ///$sql = "SELECT * FROM project WHERE project_id='".$project_id."'";
  //$rst = mysqli_query($con, $sql); 

$sql = "SELECT p.project_id, p.project_title, p.course_category,b.project_beneficiary_target,b.project_beneficiary_actual FROM project p INNER 
JOIN project_beneficiaries b ON p.project_id = b.project_id WHERE p.project_id='".$project_id."'";
$rst = mysqli_query($con, $sql);
  if (mysqli_num_rows($rst)!=0){
    $row = mysqli_fetch_array($rst);
    $projecttitle = $row['project_title'];
    $courseid = $row['course_category'];

   // $sql2 = " SELECT * FROM `project_beneficiaries` WHERE project_id='".$project_id."'";
    //if (mysqli_num_rows($rs)!=0){
      //$row2 = mysqli_fetch_array($rs);
      $targetbeneficiaries = $row['project_beneficiary_target'];
      $actualbeneficiaries = $row['project_beneficiary_actual'];  
      
  }  
}
var_dump($_POST);
if (isset($_REQUEST['submit'])){
  $projectid = $_POST['project'];
  $description = $_POST['description'];
  $targetben = $_POST['targetben'];
  $actualben = $_POST['actualben'];
 // $barangay = $_POST['barangay'];
  //$targetbeneficiaries = $_POST['targetbeneficiaries'];
  //$actualbeneficiaries = $_POST['actualbeneficiaries'];

  /*if (!empty($_POST['covered_days'])){
    $covered_days_list = $_POST['covered_days'];  
    
    foreach($covered_days_list as $days1)  
      {  
          $days .= $days1.",";  
      }  
  }*/

  /*if (strlen($projectid)!=0){
      echo $sql = "SELECT * FROM project WHERE project_id='".$projectid."'";
      $rst = mysqli_query($con, $sql); 

      if (mysqli_num_rows($rst)!=0){
        $sql_update = "UPDATE project SET project_title='$projecttitle',course_category='$courseid',date_modified=CURRENT_TIMESTAMP WHERE project_id='$project_id'";
        $rst = mysqli_query($con, $sql_update);
        
        $sql_update2 = "UPDATE project_beneficiaries SET project_beneficiary_target='$targetbeneficiaries',project_beneficiary_actual='$actualbeneficiaries',date_modified=CURRENT_TIMESTAMP WHERE project_id='$project_id'";
        $rst = mysqli_query($con, $sql_update2);
      }else{
         
      }  */
        //$sql = "INSERT INTO project (project_title,	course_category,date_created) 
        //VALUES ('$projecttitle', '$courseid',CURRENT_TIMESTAMP())";
        //if (mysqli_query($con, $sql)) {
          //$main_id = LAST_INSERT_ID($sql);
          //$main_id = mysqli_insert_id($con);

          //$msg_label =  "New record created successfully!";
          //$msg_style = "bi-star";
          //} else { 
          //$msg_label =  "Error: " . $sql . "<br>" . mysqli_error($con);
          //$msg_style = "alert-warning";
          //}
  //}elseif (isset($_REQUEST['tag'])){

   // SELECT * FROM `needs_assessement_recommendation` WHERE 1
   $projectid = $_POST['project'];
   $description = $_POST['description'];
   $targetben = $_POST['targetben'];
   $actualben = $_POST['actualben'];

echo $sql_insert = "INSERT INTO needs_assessement_recommendation (project_id,program_id,course_id,description,target_beneficiaries,actual_beneficiaries,date_created) 
    VALUES ('$projectid','$pid', '$cid','$description','$targetben','$actualben',CURRENT_TIMESTAMP())";

    if (mysqli_query($con, $sql_insert)) {
      $proj_id = mysqli_insert_id($con);
      $msg_label =  "Record Save successfully!";
      $msg_style = "bi-star";
      $style = "";

      //$sql_insert2 = "INSERT INTO project_beneficiaries (project_beneficiary_target,project_beneficiary_actual,project_id) 
      //VALUES ('$projecttitle', '$courseid','$proj_id')";
      //mysqli_query($con, $sql_insert2);
    }

  //}
}



?>
  </header><!-- End Header -->

    <div class="pagetitle">
      <h1 align="center"></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="main.php">Home</a></li>
          <li class="breadcrumb-item">Needs Assessment - Recommendation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style?>">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
    <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <!-- General Form Elements -->
              <form>
                <div class="row mb-10">
                  <label for="inputText" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-12">
                  <h2 align="center">Program:<?php echo selectProgram($_REQUEST['pid']);?></h2>
                  </div>
                </div>
                </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
    </div>
    <div class="row">    
<div class="col-lg-6">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">RECOMMENDATION</h5>
    <!-- General Form Elements -->
    <form method="post" action="main.php?action=needsassessment2reco">
    <?php if (isset($_POST['project']) || isset($_POST['projectid']) ){ 
        $projectid = isset($_POST['project']) ? $_POST['project']:$_POST['projectid']; ?>
    <div class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Selected Project: </legend>
        
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck1" checked> 
            <label class="form-check-label" for="gridCheck1">
              <?php echo selectProject($projectid); ?>
            </label>
          </div>
     
        </div>
    </div>
      <?php } ?>
    <div class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Please Select</legend>
        <div class="col-sm-10">
    <?php    
        $cid = isset($_REQUEST['cid']) ? $_REQUEST['cid']:"0";
        $project_title = "";

        $query1 = "SELECT project_id,project_title FROM project WHERE course_category='$cid' ORDER BY RAND() LIMIT 5";
        $rst1 = mysqli_query($con, $query1);
        while ( $row1 = mysqli_fetch_assoc($rst1) ) {
            $project_title = $row1['project_title'];
            $project_id = $row1['project_id'];
        ?>    
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck1" name="project" value="<?php echo $project_id; ?>" > 
            <label class="form-check-label" for="gridCheck1">
              <?php echo $project_title; ?>
            </label>
          </div>
        <?php } ?>  
          

        </div>
    </div>

      
      <div class="row mb-3">
        <label for="inputText" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="description" value="<?php echo $description;?>">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputNumber" class="col-sm-2 col-form-label">Target Beneficiaries</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" name="targetben" value="25">
        </div>
      </div>    
      <div class="row mb-3">
        <label for="inputNumber" class="col-sm-2 col-form-label">Actual Beneficiaries</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" name="actualben" value="<?php echo $actualben?>">
        </div>
      </div>

      

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
        <input type="text" name="pid" value="<?php echo $pid?>">
        <input type="text" name="cid" value="<?php echo $cid?>">
        <input type="text" name="projectid" value="<?php echo $projectid?>">
          <button type="submit" class="btn btn-primary" name="submit">Proceed</button>
        </div>
      </div>

    </form><!-- End General Form Elements -->
    </div>
</div>
    
</div>
<!-- 3rd form -->
<div class="col-lg-6">

<div class="card">
  <div class="card-body">
    <h5 class="card-title"></h5>
    <!-- General Form Elements -->
    <form method="post" action="main.php?action=needsassessment2reco">
    <?php    
        
        $query1 = "SELECT * FROM barangay ORDER BY district ASC,barangay_name ASC";
        $rst1 = mysqli_query($con, $query1);
        
        ?>    

      
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Beneficiary Barangay</label>
      <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example" name="barangay">
        <option selected>Please Select Barangay...</option>
          <?php while ( $row1 = mysqli_fetch_assoc($rst1) ) {
            $barangayname = $row1['barangay_name'];
            $barangayid = $row1['barangay_id'];
          ?>  
          
          <option value="<?php echo $barangayid;?>"><?php echo $barangayname;?></option>

        <?php } ?>  
        </select>
      </div>
    </div>

      <div class="row mb-3">
        <label for="inputNumber" class="col-sm-2 col-form-label">Beneficiaries Age Bracket</label>
        <div class="col-sm-10">
        <?php    
          $query2 = "SELECT * FROM age_bracket";
          $rst2 = mysqli_query($con, $query2);
        ?>    
            <select class="form-select" aria-label="Default select example" name="agebracket">
            <option selected>Please Select Age Bracket...</option>
              <?php while ( $row2 = mysqli_fetch_assoc($rst2) ) {
                $agebracket = $row2['age_from']."-".$row2['age_to'];
                $ab_id = $row2['ab_id'];
              ?>  
              
              <option value="<?php echo $ab_id;?>"><?php echo $agebracket;?></option>

            <?php } ?>  
            </select>
        </div>
      </div>    
      <div class="row mb-3">
      <?php    
          $query3 = "SELECT DISTINCT(program_duration) FROM program_schedule";
          $rst3 = mysqli_query($con, $query3);
        ?>  
        <label for="inputNumber" class="col-sm-2 col-form-label">Project Duration</label>
        <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example" name="projduration">
            <option selected>Please Select...</option>
              <?php while ( $row3 = mysqli_fetch_assoc($rst3) ) {
                $programduration = $row3['program_duration'];
               $sid = $row3['schedule_id'];
              ?>  
              
              <option value="<?php echo $sid;?>"><?php echo $programduration;?></option>

            <?php } ?>  
            </select>
        </div>
      </div>

      <div class="row mb-3">
      <?php    
          $query4 = "SELECT DISTINCT(start_time) as starttime, end_time FROM program_schedule";
          $rst4 = mysqli_query($con, $query4);
        ?>  
        <label for="inputNumber" class="col-sm-2 col-form-label">Available Time</label>
        <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example" name="availabletime">
            <option selected>Please Select...</option>
              <?php while ( $row4 = mysqli_fetch_assoc($rst4) ) {
                
                $s = $row4['starttime'];
                $stime = date('h:i A', strtotime($s));

                $e = $row4['end_time'];
                $etime = date('h:i A', strtotime($e));
                $time_avail = $stime."-".$etime;

               $sid = $row4['schedule_id'];
              ?>  
              
              <option value="<?php echo $sid;?>"><?php echo $time_avail;?></option>

            <?php } ?>  
            </select>
        </div>
      </div>
      
      <div class="row mb-3">
      <?php   
          $covered_days_list = "";
          $days = ""; 
          $query5 = "SELECT DISTINCT(days_covered) as dayscov FROM program_schedule";
          $rst5 = mysqli_query($con, $query5);
        ?>  
        <label for="inputNumber" class="col-sm-2 col-form-label">Days Covered</label>
        <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example" name="dayscovered">
            <option selected>Please Select...</option>
              <?php while ( $row5 = mysqli_fetch_assoc($rst5) ) {
               $sid = $row5['schedule_id'];
               $days1 = $row5['dayscov']; 
                
              ?>  
              
              <option value="<?php echo $sid;?>"><?php echo $days1;?></option>

            <?php } ?>  
            </select>
        </div>
      </div>


      <div class="row mb-3">
        <label for="inputNumber" class="col-sm-2 col-form-label">Total Hours</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" name="totalhours" value="30">
        </div>
      </div>    
      


      <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="description" value="<?php echo $description;?>">
        <input type="number" class="form-control" name="actualben" value="<?php echo $actualben?>">
        <input type="number" class="form-control" name="targetben" value="<?php echo $targetben?>">
        <input type="text" name="pid" value="<?php echo $pid?>">
        <input type="text" name="cid" value="<?php echo $cid?>">
        <input type="text" name="projectid" value="<?php echo $projectid?>">

        <input type="submit" class="btn btn-primary" name="submit2" value="Save">       
        <input type="button" class="btn btn-danger" name="create" value="Create Proposal">
        </div>
      </div>

    </form><!-- End General Form Elements -->
  

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
   
</body>

</html>