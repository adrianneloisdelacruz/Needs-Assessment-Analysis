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

  <section class="section">
    <form class="row g-3" action="main.php?action=needsassessment2" method="post">
      <?php
      $sql = "SELECT * FROM barangay ORDER BY district,barangay_name";
      $result = mysqli_query($con, $sql);

      ?>

      <div class="col-md-4">
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
      <div class="col-md-4">

        <label for="inputZone" class="form-label">Select Zone</label>
        <select id="inputZone" class="form-select" name="zone">
          <option selected>Choose...</option>

        </select>
      </div>
      <!-- select course -->
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
      <div class="text-left">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
      <hr>

    </form>


    <div class="row">
      <?php //var_dump($_REQUEST);
      $barangayid = "";
      if (isset($_POST['submit'])) {
        $barangayid = isset($_REQUEST['barangayid']) ? $_REQUEST['barangayid'] : "";
      }
      $cond = isset($_POST['courseid']) && $_POST['courseid'] == 0 ? "GROUP BY course_id" : "WHERE course_id='$courseid'";
      $select = "SELECT * FROM `program`  GROUP BY course_id ORDER BY course_id,program_title ASC";
      $result1 = mysqli_query($con, $select);

      if (mysqli_num_rows($result1) != 0) {
        while ($row1 = mysqli_fetch_array($result1)) {
          //echo selectCourse($row1['course_id']);
          $id = $row1['program_id'];
          $cid = $row1['course_id'];
      ?>
          <div class="col-md-6 border">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo selectCourse($row1['course_id']); ?></h5>
                <!-- Table with hoverable rows -->
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Program</th>
                      <th scope="col">Count</th>
                    </tr>
                  </thead>
                  <?php
                  $cond =  "WHERE course_id='$cid'";
                  $select = "SELECT * FROM `program` $cond ORDER BY course_id,program_title ASC";
                  $result = mysqli_query($con, $select);
                  while ($row = mysqli_fetch_array($result)) {
                    $id = $row['program_id'];
                    $cid = $row['course_id'];
                  ?>

                    <tbody>
                    <?php
                    echo "<tr>";

                    echo "<td><a href='main.php?action=needsassessment2reco&pid=$id&cid=$cid&bid=$barangayid'>" . $row['program_title'] . "</a></td>";
                    echo "<td align='center'>" . countProgramStat($row['program_id'], $barangayid) . "</td>";
                    //echo "<td><a href='main.php?action=needsassessment2reco&pid=$id&cid=$cid'><button type='button' class='btn btn-outline-success' >Recommendation</button></a></td>";
                    echo "</tr>";
                  } //end while
                    ?>
                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->

              </div>
            </div>
          </div>
      <?php   }
      }
      //}  
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