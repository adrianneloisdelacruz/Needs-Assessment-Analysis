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
$pid = !isset($_REQUEST['pid']) ?"":htmlspecialchars($_REQUEST['pid']); //proj id
//$projectid = !isset($_REQUEST['projectid']) ?"":htmlspecialchars($_REQUEST['projectid']);
//$reid = !isset($_REQUEST['reid']) ?"":htmlspecialchars($_REQUEST['reid']);

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
$barangay = "";
$age_bracket = "";
$days_covered = "";
$totalhours = "";
$project_duration = "";
$available_time = "";

//$query = "SELECT * FROM ";

if (isset($_REQUEST['submit'])){
 // $projectid = $_POST['projectid'];
  //$description = $_POST['description'];
  //$targetben = $_POST['targetben'];
  //$actualben = $_POST['actualben'];
 // $barangay = $_POST['barangay'];
 $barangay = $_POST['barangay'];
 $age_bracket = $_POST['age_bracket'];
 $days_covered = $_POST['days_covered'];
 $totalhours = $_POST['totalhours'];

 $pid = $_POST['pid'];
 $cid = $_POST['cid'];
 //$projduration = $_POST['projduration'];
 $available_time = $_POST['availabletime'];
}
//$recoid = isset($_REQUEST['reid']) ? $_REQUEST['reid']:"";
//$sql2 = "SELECT * FROM needs_assessement_recommendation WHERE reco_id='$recoid'";
$tag = isset($_REQUEST['tag']) ?  $_REQUEST['tag']:"";

if (strlen($tag) != 0 && $tag == 'edit'){
    $sql2 = "SELECT * FROM extension_project";
    $rst2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($rst2)!=0){  
      $row2 = mysqli_fetch_array($rst2);
      $project = strtoupper(selectProject($row2['project_id']));
      $targetben = $row2['target_beneficiaries'];
      $actualben = $row2['actual_beneficiaries'];
      $barangay = $row2['barangay'];
      $age_bracket = $row2['age_bracket']; 
      $days_covered = $row2['days_covered'];
      $total_hours =  $row2['total_hours'];
      $available_time = $row2['available_time'];
      $project_duration = $row2['project_duration'];
      $status = $row2['status']; 
    // if ($row2['status'] == '1'){ $status =  "On-Going";}elseif ($row2['status'] == '2'){ $status =  "Done";}else{$status = "Created";}
    }
}
   // SELECT * FROM `needs_assessement_recommendation` WHERE 1
   //\$projectid = $_POST['projectid'];
   //$description = $_POST['description'];
   //$targetben = $_POST['targetben'];
   //$actualben = $_POST['actualben'];
if (isset($_POST['submit'])){
  $status = $_POST['status'];
   /* $sql_update = "UPDATE needs_assessement_recommendation SET status='$status'
                  WHERE reco_id = '$recoid'
                  ";
    if (mysqli_query($con, $sql_update)) {
      
      $msg_label =  "Status updated successfully!";
      $msg_style = "bi-star";
      $style = "";

    } */

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
    <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <!-- General Form Elements -->
              <form>
                <div class="row mb-10">
                  <label for="inputText" class="col-sm-2 col-form-label"></label> 
                  <div class="col-sm-12">
                  <!-- <h2 align="center">Program:<?php ?></h2> -->
                  <h2 align="center">Extension Project : <?php echo selectProject($pid);?></h2>

                </div>
                </div>
                </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
    </div>
    <div class="row">    



<!-- 3rd form -->
<!-- General Form Elements -->

<div class="col-lg-12">

<div class="card">
  <div class="card-body">
    <h5 class="card-title"></h5>
    
    <form method="post" action="main.php?action=projectEvalres">
    <?php    
      $cond = (isset($barangay) && strlen($barangay)!=0) ? " WHERE barangay_id='$barangay'":"";  
      $query1 = "SELECT * FROM barangay $cond";
      $rst1 = mysqli_query($con, $query1);
        
    ?>    

      
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Beneficiary Barangay</label>
      <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example" name="barangay" id="barangay">
        <option> </option>
          <?php while ( $row1 = mysqli_fetch_assoc($rst1) ) {
          $barangayname = $row1['barangay_name'];
          $barangayid = $row1['barangay_id'];
          $sel = $barangayid == $_POST['barangay']?"selected":"";
          ?>  
          
          <option value="<?php echo $barangayid;?>" <?php echo $sel?>><?php echo $barangayname;?></option>

        <?php } ?>  
        </select>
      </div>
    </div>

      <div class="row mb-3">
        <label for="inputAge" class="col-sm-2 col-form-label">Beneficiaries Age Bracket</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="age_bracket" id="age_bracket" value="<?php echo $age_bracket?>">  
        </div>
      </div>

      <div class="row mb-3">
      
        <label for="inputNumber" class="col-sm-2 col-form-label">Project Duration</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="project_duration" id="" value="<?php echo $project_duration?>">
        </div>
      </div>

      <div class="row mb-3">
      
        <label for="inputNumber" class="col-sm-2 col-form-label">Available Time</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="available_time" id="" value="<?php echo $available_time?>">
        </div>
      </div>
      
      <div class="row mb-3">
      
        <label for="inputNumber" class="col-sm-2 col-form-label">Days Covered</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="days_covered" id="" value="<?php echo $days_covered?>">
        </div>
      </div>


      <div class="row mb-3">
        <label for="inputNumber" class="col-sm-2 col-form-label">Total Hours</label>
        <div class="col-sm-10">
          
          <input type="number" class="form-control" name="totalhours" value="<?php echo $total_hours; ?>">
        </div>
      </div>    
      
      <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example" name="status" id="status">  
          <option value="0" <?php echo $row2['status']==0? 'selected':'';?>>Created</option>
          <option value="1" <?php echo $row2['status']==1? 'selected':'';?>>On-going</option>
          <option value="2" <?php echo $row2['status']==2? 'selected':'';?>>Done</option>  
        </select>
      </div>
    </div>     

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
        <input type="hidden" name="pid" value="<?php echo $pid?>">
        <input type="hidden" name="cid" value="<?php echo $cid?>">
        <input type="hidden" name="projectid" value="<?php echo $projectid?>">
        <input type="hidden" name="reid" value="<?php echo $reid?>">
        <input type="submit" class="btn btn-primary" name="submit" value="Update Status">       
        <a href="main.php?action=projectEvaluationList"><input type="button" class="btn btn-danger" name="back" value="Back"></a>
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