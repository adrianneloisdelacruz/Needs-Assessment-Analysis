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
//var_dump($_REQUEST);
//$program_id = !isset($_REQUEST['pid']) ?"":htmlspecialchars($_REQUEST['pid']);
$cid = !isset($_REQUEST['cid']) ?"":htmlspecialchars($_REQUEST['cid']);
$pid = !isset($_REQUEST['pid']) ?"":htmlspecialchars($_REQUEST['pid']);
$bid = !isset($_REQUEST['bid']) ?"":htmlspecialchars($_REQUEST['bid']);

if (isset($_REQUEST['project_id'])){ 
  $projectid = $_REQUEST['project_id'];
} elseif(isset($_REQUEST['projectid'])) {
  $projectid = $_REQUEST['projectid'];
}elseif(isset($_REQUEST['projectid'])) {
  $projectid = $_REQUEST['project'];
}else{
  $projectid = "";
}
$style="display:none";
$msg_label = "";
$msg_style = "";
$projecttitle = "";
$projectdesc = "";
$barangayname  = "";
$courseid = "";
$barangay = "";
//$projectid = "";
$description = "";
$targetben = "";
$actualben = !isset($_POST['actualben']) ? countProgramStat($pid,$bid):$_POST['actualben'];
$barangay = "";
$zone = "";
$recoid = isset($_REQUEST['recoid']) ? $_REQUEST['recoid']:"";  


if (isset($_REQUEST['submit'])){
  
   // SELECT * FROM `needs_assessement_recommendation` WHERE 1
   //$projectid = $_POST['project'];
   $description = $_POST['description'];
   $targetben = $_POST['targetben'];
   $actualben = $_POST['actualben'];
   $barangay = $_POST['barangay']; //barangay_id
   $barangayname  = $_POST['barangayname'];
   $zone = $_POST['zone'];
   $recoid = "";

   $sql_insert = "INSERT INTO needs_assessement_recommendation (project_id,program_id,course_id,description,target_beneficiaries,actual_beneficiaries,barangay_id,zone,date_created) 
    VALUES ('$projectid','$pid', '$cid','$description','$targetben','$actualben','$barangay','$zone',CURRENT_TIMESTAMP())";

    if (mysqli_query($con, $sql_insert)) {
      $recoid = mysqli_insert_id($con);
      $msg_label =  "Record Save successfully!";
      $msg_style = "bi-star";
      $style = "";
    }

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
    <div class="row mb-10">
      <label for="inputText" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-12">
      <h2 align="center">Program:<?php echo selectProgram($_REQUEST['pid']);?></h2>
      </div>
    </div>
                

    <section class="section">
    <div class="card">
            <div class="card-body">
            <h5 class="card-title">RECOMMENDATION</h5>
     
              <!-- Multi Columns Form -->
              <form method="post" action="main.php?action=needsassessment2reco" class="row g-3">
              <?php    

                  $query2 = "SELECT barangay_id,barangay_name,zone FROM barangay WHERE barangay_id='$bid'";
                  $rst2 = mysqli_query($con, $query2);
                  if (mysqli_num_rows($rst2)!=0){  
                    $row2 = mysqli_fetch_assoc($rst2);
                    $barangayname = $row2['barangay_name'];
                    $barangay_id = $row2['barangay_id'];
                    $zone = $row2['zone'];
                  }
                    
              ?>

              <div class="col-md-6">
                  <label for="inputState" class="form-label">Barangay</label>
                  <input type="text" class="form-control" id="inputZone" name="barangayname" value="<?php echo $barangayname?>" readonly>
                  <input type="hidden" class="form-control" id="inputZone" name="barangay" value="<?php echo $barangay_id?>">
                </div>  
              <div class="col-md-6">
                  <label for="inputZone" class="form-label">Zone</label>
                  <input type="text" class="form-control" id="inputZone" name="zone" value="<?php echo $zone?>" readonly>
                </div>
              <!--  
                <?php if (isset($_POST['project']) || isset($_POST['projectid']) ){ 
                    $projectid = isset($_POST['project']) ? $_POST['project']:$_POST['projectid']; 
                ?>
                <div class="col-md-6">
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
                -->
      <!--          
                <div class="col-md-6">
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
    </div> -->

              <div class="col-md-12">
                  <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="description" value="<?php echo $description;?>">
                  </div>
                </div>
      

                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Target Beneficiaries</label>
                  <input type="number" class="form-control" name="targetben" value="25" required>
                </div>
                <div class="col-md-6">
                <label for="inputCity" class="form-label">Actual Beneficiaries</label>
                <input type="number" class="form-control" name="actualben" id="actualben" value="<?php echo $actualben?>" required>
                </div>
                
                <div class="text-center">
                  <input type="hidden" name="pid" value="<?php echo $pid?>">
                  <input type="hidden" name="cid" value="<?php echo $cid?>">
                  <input type="hidden" name="projectid" value="<?php echo $projectid?>">
                  <input type="hidden" name="recoid" value="<?php echo $recoid?>">
                  <button type="submit" class="btn btn-primary" name="submit">Save</button>
                  <a href="main.php?action=needsassessment2reco2&tag=reco2&pid=<?php echo $pid?>&cid=<?php echo $cid?>&projectid=<?php echo $projectid?>&recoid=<?php echo $recoid?>&bid=<?php echo $barangay?>"><button type="button" class="btn btn-danger" name="proceed">Proceed</button></a>
                           
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
     // alert(barangayID);
      if(barangayID){
          $.ajax({
              type:'POST',
              url:'ajaxSelect.php',
              data:{'barangay_id':barangayID},
              success:function(result){
                var resArray = result.split("=");
                  $('#inputZone').val(resArray[0]);
                  $('#actualben').val(resArray[1]);
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