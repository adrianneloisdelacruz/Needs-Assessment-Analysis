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
<?php //var_dump($_REQUEST);
//$program_id = !isset($_REQUEST['pid']) ?"":htmlspecialchars($_REQUEST['pid']);
$cid = !isset($_REQUEST['cid']) ?"":htmlspecialchars($_REQUEST['cid']);
$pid = !isset($_REQUEST['pid']) ?"":htmlspecialchars($_REQUEST['pid']);
$bid = !isset($_REQUEST['bid']) ?"":htmlspecialchars($_REQUEST['bid']);
$projectid = !isset($_REQUEST['projectid']) ?"":htmlspecialchars($_REQUEST['projectid']);
$recoid = !isset($_REQUEST['recoid']) ?"":htmlspecialchars($_REQUEST['recoid']);
$barangayname = !isset($_REQUEST['barangayname']) ? "":$_REQUEST['barangayname'];
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
$implementation_date = "";

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
 $implementation_date = $_POST['implementation_date'];

$radio_duration = isset($_REQUEST['radio_duration']) ? $_REQUEST['radio_duration']:"";
if (strlen($radio_duration)!=0){

$cond = isset($_REQUEST['radio_duration']) ? " AND schedule_id='".$_REQUEST['radio_duration']."'":"";
$query4 = "SELECT DISTINCT(start_time) as starttime, end_time,program_duration,total_hours,days_covered,schedule_id FROM program_schedule WHERE program_id='$pid'  $cond";
$rst4 = mysqli_query($con, $query4);
  
if (mysqli_num_rows($rst4)!=0){  
    $row4 = mysqli_fetch_assoc($rst4);
    $projduration = $row4['program_duration'];
    $totalhours = $row4['total_hours'];
    $dayscovered = $row4['days_covered'];
    $s = $row4['starttime'];
    $stime = date('h:i A', strtotime($s));
    $e = $row4['end_time'];
    $etime = date('h:i A', strtotime($e));
    $availabletime = $stime."-".$etime;
  }
}

   $sql_update = "UPDATE needs_assessement_recommendation SET barangay_id='$barangay',
                  age_bracket='$agebracket',
                  days_covered='$dayscovered',
                  total_hours='$totalhours',
                  available_time = '$availabletime',
                  project_duration = '$projduration',
                  project_id ='$projectid',implementation_date='$implementation_date',
                  date_modified=CURRENT_TIMESTAMP
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
                 <h2 align="center">Program:<?php echo selectProgram($pid);?></h2>
                   <!-- <h2 align="center">Program:<?php echo selectProject($_REQUEST['projectid']);?></h2>  -->

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
        
      $query1 = "SELECT * FROM barangay WHERE barangay_id='$bid'";
      $rst1 = mysqli_query($con, $query1);
      if (mysqli_num_rows($rst1)!=0){  
        $row2 = mysqli_fetch_assoc($rst1);
        $barangayname = $row2['barangay_name'];
        $barangay = $row2['barangay_id'];
        $zone = $row2['zone'];
      }
        ?>    

      
    <div class="row mb-3">
      <label class="col-sm-10 col-form-label" align="center" style="padding-right: 10px;"><SPAN STYLE="font-size:18.0pt;font-weight:bold">Beneficiaries : Barangay <?php echo $barangayname?></SPAN></label>
      <div class="col-sm-10">
        <input type="hidden" class="form-control" id="inputZone" name="barangayname" value="<?php echo $barangayname?>" readonly>
        <input type="hidden" class="form-control" id="inputZone" name="barangay" value="<?php echo $bid?>">
      </div>
    </div>
    <div class="row mb-3" align="center" style="padding-left: 60px;">
      <label class="col-sm-4 col-form-label" align="right">Implementation Date : </label>
      <div class="col-sm-3">
        <input type="date" class="form-control" id="inputDate" name="implementation_date" value="<?php echo $implementation_date?>" required>
        
      </div>
    </div>
    <div class="row mb-3" align="center" style="padding-left: 60px;">
      <label class="col-sm-4 col-form-label" align="right">Age Of the Beneficiaries : </label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="inputAge" name="agebracket" value="<?php echo getAgeBracket($pid,$bid);?>" >
        
      </div>
    </div>
      <div class="row">

  <?php    
          $radio_duration = isset($_REQUEST['radio_duration']) ? $_REQUEST['radio_duration']:"";
          $cond = isset($_REQUEST['radio_duration']) ? " AND schedule_id='".$_REQUEST['radio_duration']."'":"";
          $query4 = "SELECT DISTINCT(start_time) as starttime, end_time,program_duration,total_hours,days_covered,schedule_id FROM program_schedule WHERE program_id='$pid'  $cond";
          $rst4 = mysqli_query($con, $query4);
  
             while ( $row4 = mysqli_fetch_assoc($rst4) ) {
                $projduration = $row4['program_duration'];
                $totalhours = $row4['total_hours'];
                $dayscovered = $row4['days_covered'];
                $s = $row4['starttime'];
                $stime = date('h:i A', strtotime($s));

                $e = $row4['end_time'];
                $etime = date('h:i A', strtotime($e));
                $availabletime = $stime."-".$etime;

                $sid = $row4['schedule_id'];
           // $sel = $time_avail == $_POST['availabletime'] ? "selected":"";
    ?>      
          
          <div class="col-lg-3" align="center">  
          <div class="card">
            <div class="card-body" align="center">
              <h5 class="card-title"></h5>
                <!-- Table with hoverable rows -->
                <table class="table table-hover" align="center">
                <thead>
                  <tr align="center"> 
                   <?php $sel = ($sid == $radio_duration) ? "checked":"";?>
                  
                   <th scope="col"><input class="form-check-input" type="radio" name="radio_duration" value="<?php echo $sid ?>" <?php echo $sel; ?>required>&nbsp;Program Duration</th>
                  </tr>
                </thead>
              
                          
                  <tbody>
                     
                      <tr align="center">
                        <td>Time : &nbsp; <?php echo  $availabletime ?></td>
                        <input type="hidden" name="availabletime"  value="<?php echo $availabletime; ?>">
                      </tr>

                      <tr align="center">
                        <td> &nbsp; <?php echo  $projduration ?></td>  
                        <input type="hidden" name="projduration" value="<?php echo $projduration; ?>">
                      </tr>
                        
                      <tr align="center">
                        <td>Total Hours : &nbsp; <?php echo  $totalhours ?></td>
                        <input type="hidden" name="totalhours" value="<?php echo $totalhours; ?>">
                      </tr>
                      <tr align="center">
                      <td>Days : &nbsp; <?php echo  $dayscovered ?></td>
                      <input type="hidden" name="dayscovered" value="<?php echo $dayscovered; ?>">
                      </tr>

                      </tbody>
                    </table>
                            <!-- End Table with hoverable rows -->
                      
            </div>
          </div>
        </div>
        <?php   }

?>

      <div class="row mb-3" align="center" style="padding-right: 280px;">
        <label class="col-sm-2 col-form-label"></label> 
        <div class="col-sm-10">
        <input type="hidden" name="pid" value="<?php echo $pid?>">
        <input type="hidden" name="cid" value="<?php echo $cid?>">
        <input type="hidden" name="bid" value="<?php echo $bid?>">
        <input type="hidden" name="projectid" value="<?php echo $projectid?>">
        <input type="hidden" name="recoid" value="<?php echo $recoid?>">
        
        <input type="submit" class="btn btn-primary" name="submit" value="Save"> <br> <br>

        <a href="main.php?action=needsassessment2proposal&pid=<?php echo $pid?>&cid=<?php echo $cid?>&projectid=<?php echo $projectid?>&recoid=<?php echo $recoid?>&bid=<?php echo $bid?>&idate=<?php echo $implementation_date;?>"><input type="button" class="btn btn-danger" name="create" value="Proposal for BSIT"> </a>

        <a href="main.php?action=needsassessment2proposalbsap&pid=<?php echo $pid?>&cid=<?php echo $cid?>&projectid=<?php echo $projectid?>&recoid=<?php echo $recoid?>&bid=<?php echo $bid?>&idate=<?php echo $implementation_date;?>"><input type="button" class="btn btn-danger" name="create" value="Proposal for BSAP"> </a>

        <a href="main.php?action=needsassessment2proposalbsp&pid=<?php echo $pid?>&cid=<?php echo $cid?>&projectid=<?php echo $projectid?>&recoid=<?php echo $recoid?>&bid=<?php echo $bid?>&idate=<?php echo $implementation_date;?>"><input type="button" class="btn btn-danger" name="create" value="Proposal for BSP"> </a> <br><br>


        <a href="main.php?action=needsassessment2proposalbsmath&pid=<?php echo $pid?>&cid=<?php echo $cid?>&projectid=<?php echo $projectid?>&recoid=<?php echo $recoid?>&bid=<?php echo $bid?>&idate=<?php echo $implementation_date;?>"><input type="button" class="btn btn-danger" name="create" value="Proposal for BSMATH"> </a> 


        <a href="main.php?action=needsassessment2proposalbscs&pid=<?php echo $pid?>&cid=<?php echo $cid?>&projectid=<?php echo $projectid?>&recoid=<?php echo $recoid?>&bid=<?php echo $bid?>&idate=<?php echo $implementation_date;?>"><input type="button" class="btn btn-danger" name="create" value="Proposal for BSCS"> </a>


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