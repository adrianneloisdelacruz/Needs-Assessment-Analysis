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

$course_id = isset($_REQUEST['cid']) ? $_REQUEST['cid']:"";//course id
$program_id = isset($_REQUEST['pid']) ? $_REQUEST['pid']:""; //program id
$tag = !isset($_REQUEST['tag']) ?"":htmlspecialchars($_REQUEST['tag']);
$sid = !isset($_REQUEST['sid']) ?"":htmlspecialchars($_REQUEST['sid']);

?>


<div class="pagetitle">
    <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="main.php">Home</a></li>
      <li class="breadcrumb-item">Schedule</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

    <section class="section">
      <div class="row">
      <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Schedule for Program under <?php echo selectProgram($program_id);?></h5>
              <!-- Table with stripped rows -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th scope="col">Program Duration</th>
                  <th scope="col">Time</th>
                  <th scope="col">Covered Days</th>
                  <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  if (isset($_REQUEST['cid'])){
                    
                   $select = "SELECT * FROM program_schedule WHERE program_id='$program_id' AND course_id='$course_id'";
                    $result = mysqli_query($con, $select);  
                
                    if (mysqli_num_rows($result) != 0){
                      
                        while($row = mysqli_fetch_array($result)){
                            $pid = $row['program_id'];
                            $cid = $row['course_id'];
                            $sid = $row['schedule_id'];
                            /* $s = strtotime($row['start_time']);
                            $stime =  date("H:i A", $s);
                            $e = strtotime($row['end_time']);
                            $etime =  date("H:i A", $e);
                            */

                            $s = $row['start_time'];
                            $stime = date('h:i A', strtotime($s));

                            $e = $row['end_time'];
                            $etime = date('h:i A', strtotime($e));

                            echo "<tr>";
                               // echo "<td>" . $row['sid'] . "</td>";
                                echo "<td>" . $row['program_duration']."</td>";
                                echo "<td>" . $stime."-".$etime."</td>";
                                echo "<td>" . strtoupper($row['days_covered'])."</td>";
                                //echo "<td>" . $row['program_duration']."</td>";
                                echo "<td><a href='main.php?action=scheduleform&tag=edit&pid=$pid&cid=$cid&sid=$sid'><button type='button' class='btn btn-outline-success'>Add/Edit Schedule</button></a>";
                                echo " | <button type='button' class='btn btn-outline-danger deletebtn' name='deletebtn' id='$sid' value='$sid'>Delete</button></td>";
                            echo "</tr>";
                        }//end while
                                     
                    }
                  }  
                ?>    
                 
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

              <div class="text-center"> 
              <a href="main.php?action=scheduleform&tag=new&pid=<?php echo $program_id?>&cid=<?php echo $course_id ?>"><button type="button" class="btn btn-primary">Add New Schedule</button></a>
              </div>

            </div>
          </div>
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

$(document).ready(function(){
  $(".deletebtn").click(function(){
    if (!confirm("Do you want to delete this?")){
      return false;
    }else{
      var del_id = $(this).attr('id');
      var tag = "delschedule";
            $.ajax({
                type:'POST',
                url:'ajaxDelete.php',
                //data:'delete_id='+del_id + 'tag=' + 'delexproject',
                data: {
                  delete_id: del_id,
                    tag: tag
                  },
                success: function(data)
                {
                    //reload page
                    location.reload();
                }
            });

    }
  });
});
</script>  

</body>

</html>