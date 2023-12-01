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
  $barangayid = isset($_POST['barangayid']) ? $_POST['barangayid'] : "";
  $zone = isset($_POST['zone']) ? $_POST['zone'] : "";
  $courseid = isset($_POST['courseid']) ? $_POST['courseid'] : "";

  ?>
  </header><!-- End Header -->

  <div class="pagetitle">
    <h1 align="center"></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="main.php">Home</a></li>
        <li class="breadcrumb-item">Needs Assessment - Program</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="display:none">

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>


  <!-- FORM HERE -->
  <section class="section">
    <form class="row g-3" action="main.php?action=needsassessment2" method="post">
      <?php
      $sql = "SELECT * FROM barangay ORDER BY district,barangay_name";
      $result = mysqli_query($con, $sql);

      ?>

      <div class="col-md-9">
        <!--  <label for="inputEmail5" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail5"> -->
        <label for="inputBarangay" class="form-label">Select Barangay</label>
        <select id="inputBarangay" class="form-select" name="barangayid">
          <option selected>Choose...</option>
          <?php while ($row = mysqli_fetch_array($result)) {
            $sel = $row['barangay_id'] == $barangayid ? "Selected" : "";
            echo "<option value='" . $row['barangay_id'] . "' $sel>" . strtoupper($row['barangay_name']) . "-Zone:" . $row['zone'] . "</option>";
          } ?>
        </select>
      </div>

      <?php
      $sql = "SELECT * FROM course_category";
      $result = mysqli_query($con, $sql);
      ?>
      <!-- 
                <div class="col-md-4">
                  <label for="inputCourse" class="form-label">Select Course</label>
                  <select id="inputCourse" class="form-select" name="courseid">
                    <option value="0" selected>All</option>
                    <?php while ($row = mysqli_fetch_array($result)) {
                      $sel = $row['course_id'] == $courseid ? "Selected" : "";
                      echo "<option value='" . $row['course_id'] . "' $sel>" . strtoupper($row['course_title']) . "</option>";
                    } ?>
                  </select>
                </div>
                  -->
      <div class="col-md-3">
        <label for="inputZone" class="form-label" style="visibility: hidden;">Select Zone</label>
        <div class="d-flex justify-content-evenly">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </div>
      <hr>
    </form>

    <div class="row p-3">
      <?php //var_dump($_REQUEST);
      $barangayid = "";
      if (isset($_POST['submit']) && $_POST['barangayid'] != 'Choose...') {
        $barangayid = isset($_REQUEST['barangayid']) ? $_REQUEST['barangayid'] : "";
        $sql_6 = "SELECT COUNT(*) AS project_count FROM `responded_program` WHERE barangay = '{$barangayid}'";
        $res_6 = $con->query($sql_6);
        if ($res_6) {
          $row_6 = $res_6->fetch_assoc();
      ?>
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content">
                <h5 class="card-title">BARANGAY <?= selectBarangay($barangayid) ?> | TOTAL PROJECT: <?= $row_6['project_count'] ?> </h5>
              </div>
              <?php
              $barangay_id = $barangayid;
              $sql_5 = "SELECT assessment_main_info.family_name,
                assessment_main_info.first_name, 
                course_category.course_title, course_category.course_id,
                program.program_title, program.program_id,
                resprogram.intend_beneficiary
                FROM `responded_program` AS resprogram
                INNER JOIN program ON resprogram.program_id = program.program_id
                INNER JOIN course_category ON program.course_id = course_category.course_id 
                INNER JOIN assessment_main_info ON resprogram.assessment_id = assessment_main_info.assessment_id
                WHERE resprogram.barangay = '{$barangay_id}'            
                ";

              $res_5 = $con->query($sql_5);
              if ($res_5) {
                while ($row_5 = $res_5->fetch_assoc()) { ?>
                  <div class="row">
                    <div class="col-md-3">
                      <h5><?= $row_5['family_name'] ?> <?= $row_5['first_name'] ?></h5>
                    </div>
                    <div class="col-md-2">
                      <p>Course: <?= $row_5['course_title'] ?></p>
                    </div>
                    <div class="col-md-3">
                      <p>Program Title: <?= $row_5['program_title'] ?></p>
                    </div>
                    <div class="col-md-2">
                      <p>Beneficiary: <?= $row_5['intend_beneficiary'] ?></p>
                    </div>
                    <div class="col-md-2">
                      <a class="btn btn-primary" href='main.php?action=needsassessment2reco&pid=<?= $row_5['program_id'] ?>&cid=<?= $row_5['course_id'] ?>&bid=<?= $barangay_id ?>'>Asses</a>
                    </div>

                  </div>
                <?php }
              } else { ?>
                <div class="d-flex justify-content-between">
                  <h5>No Project Found</h5>
                </div>
              <?php }
              ?>

            </div>
          </div>

        <?php }
      } else { ?>
        <?php
        $sql_3 = "SELECT barangay.barangay_name, barangay.barangay_id, IFNULL(project_count, 0) AS project_count
      FROM barangay
      LEFT JOIN (
          SELECT barangay, COUNT(*) AS project_count
          FROM responded_program
          GROUP BY barangay
      ) AS subquery ON subquery.barangay = barangay.barangay_id ORDER BY project_count DESC
      ";
        $res_3 = $con->query($sql_3);
        if ($res_3) {
          while ($row = $res_3->fetch_assoc()) { ?>
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content">
                  <h5 class="card-title">BARANGAY <?= $row['barangay_name'] ?> | TOTAL PROJECT: <?= $row['project_count'] ?> </h5>
                </div>
                <?php
                $barangay_id = $row['barangay_id'];
                $sql_5 = "SELECT assessment_main_info.family_name,
                assessment_main_info.first_name, 
                course_category.course_title, course_category.course_id,
                program.program_title, program.program_id,
                resprogram.intend_beneficiary
                FROM `responded_program` AS resprogram
                INNER JOIN program ON resprogram.program_id = program.program_id
                INNER JOIN course_category ON program.course_id = course_category.course_id 
                INNER JOIN assessment_main_info ON resprogram.assessment_id = assessment_main_info.assessment_id
                WHERE resprogram.barangay = '{$barangay_id}'            
                ";

                $res_5 = $con->query($sql_5);
                if ($res_5) {
                  while ($row_5 = $res_5->fetch_assoc()) { ?>
                    <div class="row">
                      <div class="col-md-3">
                        <h5><?= $row_5['family_name'] ?> <?= $row_5['first_name'] ?></h5>
                      </div>
                      <div class="col-md-2">
                        <p>Course: <?= $row_5['course_title'] ?></p>
                      </div>
                      <div class="col-md-3">
                        <p>Program Title: <?= $row_5['program_title'] ?></p>
                      </div>
                      <div class="col-md-2">
                        <p>Beneficiary: <?= $row_5['intend_beneficiary'] ?></p>
                      </div>
                      <div class="col-md-2">
                        <a class="btn btn-primary" href='main.php?action=needsassessment2reco&pid=<?= $row_5['program_id'] ?>&cid=<?= $row_5['course_id'] ?>&bid=<?= $barangay_id ?>'>Asses</a>
                      </div>

                    </div>
                  <?php }
                } else { ?>
                  <div class="d-flex justify-content-between">
                    <h5>No Project Found</h5>
                  </div>
                <?php }
                ?>

              </div>
            </div>

        <?php }
        }
        ?>
      <?php }
      ?>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#inputBarangay').on('change', function() {
        var barangayID = $(this).val();

        if (barangayID) {
          $.ajax({
            type: 'POST',
            url: 'ajaxData.php',
            data: 'barangay_id=' + barangayID,
            success: function(html) {
              $('#inputZone').html(html);
              // $('#city').html('<option value="">Select state first</option>'); 
            }
          });
        } else {
          //$('#state').html('<option value="">Select country first</option>');
          // $('#city').html('<option value="">Select state first</option>'); 
        }
      });

      /* $('#city').on('change', function(){
           var cityID = $(this).val();
           if(cityID){
               $.ajax({
                   type:'POST',
                   url:'ajaxData.php',
                   data:'city_id='+cityID,
                   success:function(html){
                       $('#city').html(html);
                   }
               }); 
           }else{
               $('#city').html('<option value="">Select ...</option>'); 
           }
       }); */
    });
  </script>

</body>

</html>