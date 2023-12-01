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

  </header><!-- End Header -->

    <div class="pagetitle">
      <h1 align="center"></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="main.php">Home</a></li>
          <li class="breadcrumb-item">Program</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="display:none">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
    <div class="card">
            <div class="card-body">
              
              <!-- Multi Columns Form -->
              <form class="row g-3" action="main.php?action=schedulelist" method="post">
              <?php  
                  $sql = "SELECT * FROM course_category";
                  $result = mysqli_query($con,$sql);
                  
                ?>
                <div class="col-md-6">
                <!--  <label for="inputEmail5" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail5"> -->
                  <label for="inputCourse" class="form-label">Select Course</label>
                  <select id="inputCourse" class="form-select" name="courseid">
                    <option selected>Choose...</option>
                    <?php  while ($row = mysqli_fetch_array($result)) {
                      $sel = $row['course_id'] == $_POST['courseid'] ? "Selected":"";
                      echo "<option value='" . $row['course_id'] . "' $sel>" . strtoupper($row['course_title']) . "</option>";
                    } ?>
                  </select>
                </div>
                
                <div class="text-left">
                  <button type="submit" class="btn btn-primary">Check Schedule</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->
              <form class="row g-3" action="main.php?action=schedulelist" method="post">
                  
                <?php  
                if (isset($_POST['courseid'])){
                    $course_id = $_POST['courseid'];
                    //echo $select = "SELECT s.program_duration,s.start_time,s.end_time,s.days_covered,p.program_title,p.course_id,p.program_id FROM program_schedule s LEFT JOIN program p ON  s.course_id=p.course_id WHERE s.course_id='$course_id' ORDER BY p.program_title ASC";
                    $select = "SELECT * FROM program WHERE course_id='$course_id'";
                    $result = mysqli_query($con, $select);  
                    if (mysqli_num_rows($result) != 0){
                         $select1 = "SELECT * FROM program WHERE course_id='$course_id'";
                         $result1 = mysqli_query($con, $select1);  
                  ?>    
                          <h5 class="card-title">Schedule for Program under <?php echo selectCourse($course_id);?></h5>
                           <!-- Table with stripped rows -->

                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Program</th>
                                    <!-- <th scope="col">Program Duration</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Covered Days</th> -->
                                    <th scope="col">Action</th>                                    
                                  </tr>
                                </thead>
                                <tbody>
                                     <?php
                                              while($row = mysqli_fetch_array($result1)){
                                                  $id = $row['program_id'];
                                                  $cid = $row['course_id'];
                                                  echo "<tr>";
                                                      echo "<td>" . $row['program_id'] . "</td>";
                                                      echo "<td>" . $row['program_title']."</td>";
                                                      //echo "<td></td>";
                                                      //echo "<td></td>";
                                                      //echo "<td></td>";
                                                      echo "<td><a href='main.php?action=schedulelist2&pid=$id&cid=$cid'><button type='button' class='btn btn-outline-success'>Add/Edit Schedule</button></a></td>";
                                                  echo "</tr>";
                                              }//end while
                                    ?>    
                                  
                                    
                                  </tbody>
                                </table>
                                <!-- End Table with stripped rows --> 
            <?php          
                    } //end query
                      //if records exist
              
                }//isset course id
              ?>  
              </form>     

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

</body>

</html>