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
$recoid = !isset($_REQUEST['recoid']) ?"":htmlspecialchars($_REQUEST['recoid']);

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
$agebracket = "";
$dayscovered = "";
$totalhours = "";
$projduration = "";
$availabletime = "";

//$query = "SELECT * FROM ";////////

if (isset($_REQUEST['submit'])){
 // $projectid = $_POST['projectid'];
  //$description = $_POST['description'];
  //$targetben = $_POST['targetben'];
  //$actualben = $_POST['actualben'];
 // $barangay = $_POST['barangay'];
 $barangay = $_POST['barangay'];
 $agebracket = $_POST['agebracket'];
 $dayscovered = $_POST['dayscovered'];
 $totalhours = $_POST['totalhours'];
 
 $pid = $_POST['pid'];
 $cid = $_POST['cid'];
 $projduration = $_POST['projduration'];
 $availabletime = $_POST['availabletime'];

//$recoid = $_REQUEST['recoid'];


   // SELECT * FROM `needs_assessement_recommendation` WHERE 1
   //$projectid = $_POST['projectid'];
   //$description = $_POST['description'];
   //$targetben = $_POST['targetben'];
   //$actualben = $_POST['actualben'];

   $sql_update = "UPDATE needs_assessement_recommendation SET barangay_id='$barangay',
                  age_bracket='$agebracket',
                  days_covered='$dayscovered',
                  total_hours='$totalhours',
                  available_time = '$availabletime',
                  project_duration = '$projduration'
                  WHERE reco_id = '$recoid'
                  ";
    if (mysqli_query($con, $sql_update)) {
      
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
                  <!-- <h2 align="center">Program:<?php echo selectProgram($_REQUEST['pid']);?></h2> -->
                  <h2 align="center">Program:<?php echo selectProject($_REQUEST['projectid']);?></h2>

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
    
    <form method="post" action="main.php?action=needsassessment2reco2">
    <?php    
        
      $query1 = "SELECT * FROM barangay ORDER BY district ASC,barangay_name ASC";
      $rst1 = mysqli_query($con, $query1);
        
        ?>    

      
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Beneficiary Barangay</label>
      <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example" name="barangay" id="barangay">
        <option selected>Please Select Barangay...</option>
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

        <?php    
          $query2 = "SELECT * FROM age_bracket";
          $rst2 = mysqli_query($con, $query2);
        ?>

      <div class="row mb-3">
        <label for="inputAge" class="col-sm-2 col-form-label">Beneficiaries Age Bracket</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="agebracket" id="agebracket" value="<?php echo $agebracket?>">
           <!-- 
            <select class="form-select" aria-label="Default select example" name="agebracket">
            <option selected>Please Select Age Bracket...</option>
              <?php while ( $row2 = mysqli_fetch_assoc($rst2) ) {
                $agebracket = $row2['age_from']."-".$row2['age_to'];
                $ab_id = $row2['ab_id'];
              ?>  
              
              <option value="<?php echo $ab_id;?>"><?php echo $agebracket;?></option>

            <?php } ?>  
            </select> -->
        </div>
      </div>

      <div class="row mb-3">
      <?php    
        $query3 = "SELECT DISTINCT program_duration FROM program_schedule";
        $rst3 = mysqli_query($con, $query3);
      ?>  
        <label for="inputNumber" class="col-sm-2 col-form-label">Project Duration</label>
        <div class="col-sm-10">
        <select class="form-select" aria-label="Default select example" name="projduration">
            <option selected>Please Select...</option>
              <?php while ( $row3 = mysqli_fetch_assoc($rst3) ) {
                $programduration = $row3['program_duration'];
                $sid = $row3['schedule_id'];
                $sel = $programduration == $_POST['projduration'] ? "selected":"";
              ?>  
              
              <option value="<?php echo $programduration;?>" <?php echo $sel?> ><?php echo $programduration;?></option>

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
               $sel = $time_avail == $_POST['availabletime'] ? "selected":"";
              ?>  
              
              <option value="<?php echo $time_avail;?>" <?php echo $sel?>><?php echo $time_avail;?></option>

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
              $sel =  $days1 == $_POST['dayscovered'] ? "selected":"";
              ?>  
              
              <option value="<?php echo $days1;?>" <?php echo $sel?>><?php echo $days1;?></option>

            <?php } ?>  
            </select>
        </div>
      </div>


      <div class="row mb-3">
        <label for="inputNumber" class="col-sm-2 col-form-label">Total Hours</label>
        <div class="col-sm-10">
          <?php if(isset($_POST['totalhours'])){ $total_hrs = $_POST['totalhours'];}else{ $total_hrs = "30";}?>
          <input type="number" class="form-control" name="totalhours" value="<?php echo $total_hrs; ?>">
        </div>
      </div>    
      


      <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
        <input type="hidden" name="pid" value="<?php echo $pid?>">
        <input type="hidden" name="cid" value="<?php echo $cid?>">
        <input type="hidden" name="projectid" value="<?php echo $projectid?>">
        <input type="hidden" name="recoid" value="<?php echo $recoid?>">
        <input type="submit" class="btn btn-primary" name="submit" value="Save">       
        <a href="main.php?action=needsassessment2proposal&pid=<?php echo $pid?>&cid=<?php echo $cid?>&projectid=<?php echo $projectid?>&recoid=<?php echo $recoid?>&brgyid=<?php echo $barangay?>"><input type="button" class="btn btn-danger" name="create" value="Create Proposal"></a>
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