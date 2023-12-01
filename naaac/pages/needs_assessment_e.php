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

  $main_id = !isset($_REQUEST['main_id']) ? "" : htmlspecialchars($_REQUEST['main_id']);
  $bid = !isset($_REQUEST['bid']) ? "" : htmlspecialchars($_REQUEST['bid']);
  $pname = "";
  $nobenefits = "0";
  $intendbenefits = 0;

  $sql = "SELECT * FROM assessment_main_info WHERE assessment_id='" . $main_id . "'";
  $rst = mysqli_query($con, $sql);

  if (isset($_POST['programname']) && $_POST['programname'] != NULL) {

    $pname = $_POST['programname'];
    $nobenefits = $_POST['noofbenefits'];
    $intendbenefits = $_POST['intendbenefits'];

    $sql = "SELECT * FROM assessment_main_info WHERE assessment_id=$main_id";
    $rst = mysqli_query($con, $sql);

    if (mysqli_num_rows($rst) != 0) {
      echo $insert = "INSERT INTO responded_program VALUES('','$pname','$nobenefits','$intendbenefits','$main_id',CURRENT_TIMESTAMP)";
      if (mysqli_query($con, $insert)) {
        $msg_label =  "New record created successfully!";
        $msg_style = "bi-star";
        $style = "";
      } else {
        $msg_label =  "Error: " . $sql . "<br>" . mysqli_error($con);
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
        <li class="breadcrumb-item">Needs Assessment Form</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="display:none">
    <i class="bi <?php echo $msg_style; ?> me-1"></i>
    <?php echo $msg_label ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <section class="section">
    <div class="row">
      <div class="card">
        <div class="card-body">


          <!-- ----------------------------------last tab Section E --------------------------------  --- -->

          <form class="row g-3" id="formE" method="post" action="main.php?action=needsassessmentE">
            <h5 class="card-title">Section E - Extension & Community Dev. Program</h5>
            <div class="col-md-6">
              <label for="inputProgram" class="form-label">Program</label>
              <!-- <input type="text" name="programname" class="form-control" id="programname">-->
              <?php
              $sql = "SELECT * FROM program";
              $result = mysqli_query($con, $sql);
              ?>


              <select id="inputProgram" class="form-select" name="programname">
                <?php while ($row = mysqli_fetch_array($result)) {
                  //$sel = $row['program_id'] == $_POST['programname'] ? "Selected":"";
                  //echo "<input type='hidden' name='programid' id='programid' value='".$row['program_id']."'>";
                  echo "<option value='" . $row['program_id'] . "-" . $row['program_title'] . "' required >" . strtoupper($row['program_title']) . "</option>";
                } ?>

                <!-- 
                    <option value="Basic Programming">Basic Programming</option> 
                    <option value="Word Processing">Word Processing</option>
                    <option value="Graphics Design">Graphics Design</option>
                    <option value="Multimedia Presentation">Multimedia Presentation</option>
                    <option value="Spreadsheet Application">Spreadsheet Application</option>
                    <option value="Values Formation">Values Formation</option>
                    <option value="Behavioral Assessment">Behavioral Assessment</option>
                    <option value="Seminar as Anti-Bullying">Seminar as Anti-Bullying</option>
                    <option value="Seminar on work balance in working method">Seminar on work balance in working method</option>
                    <option value="Parent and child concealing">Parent and child concealing</option>
                    <option value="Parent and child coaching">Parent and child coaching</option>
                    <option value="Mathematics Tutorial">Mathematics Tutorial</option>
                    <option value="Seminar on Basic Business Management using Mathematics Approach">Seminar on Basic Business Management using Mathematics Approach</option>
                    <option value="Science Literacy Program">Science Literacy Program</option>
                    <option value="Tutorial/Seminar on the use of the prototype water testing facility">Tutorial/Seminar on the use of the prototype water testing facility</option>
                    <option value="Workshop on the utilization of the weakness station device">Workshop on the utilization of the weakness station device</option>
-->
              </select>
            </div>

            <span> </span>
            <div class="col-md-6">
              <!-- <label for="inputBenefits" class="form-label">How many should benefits in this Program?</label> -->
              <label for="inputBenefits" class="form-label">No. of Target Beneficiaries</label>
              <input type="text" name="noofbenefits" class="form-control" id="noofbenefits" value="25" required>
            </div>
            <span> </span>
            <div class="col-md-6">
              <!--  <label for="inputIntenBenefits" class="form-label">How many wants or intend to benefits from the program?</label> -->
              <label for="inputIntenBenefits" class="form-label">No. of Actual Beneficiaries</label>
              <input type="text" name="intendbenefits" class="form-control" id="intendbenefits" required>
            </div>
            <span> </span>

            <div class="text-left">
              <input type="hidden" name="main_id" value="<?= $main_id; ?>">
              <input type="hidden" name="bid" value="<?= $bid; ?>">
              <input type="hidden" name="action" value="needsassessmentE">
              <button type="submit" class="btn btn-primary" id="savebtn">Add & Save</button>
              <a href="main.php?action=recommendation&main_id=<?= $main_id; ?>&bid=<?php echo $bid ?>"><input type="button" class="btn btn-warning" id="recostat" value="Check for Recommendation"></a>
            </div>
            <br />
            <div class="text-center">

              <table class="table table-bordered data-table">
                <thead>
                  <th>Program</th>
                  <th>No. that should benefits</th>
                  <th>No. that intend to benefits</th>
                  <th width="200px">Action</th>
                </thead>
                <tbody>

                </tbody>
              </table>

            </div>
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

  <script type="text/javascript">
    $("#savebtn").on("click", function(e) {
      e.preventDefault();
      var pname = $("select[name='programname']").val();
      var nobenefits = $("input[name='noofbenefits']").val();
      var intendbenefits = $("input[name='intendbenefits']").val();
      var mainid = $("input[name='main_id']").val();
      var bid = $("input[name='bid']").val();

      //var firstName = $("#firstName").val();
      //var lastName = $("#lastName").val();
      //var email = $("#email").val();
      // var message = $("#message").val();

      if (pname == '' || nobenefits == '' || intendbenefits == '') {
        alert("Please fill all fields.");
        return false;
      } else {

        $(".data-table tbody").append("<tr data-programname='" + pname + "' data-noofbenefits='" + nobenefits + "' data-intendbenefits='" + intendbenefits + "'><td>" + pname + "</td><td>" + nobenefits + "</td><td>" + intendbenefits + "</td><td><button class='btn btn-danger btn-xs btn-delete'align='center'>Delete</button></td></tr>");

        $.ajax({
          type: "POST",
          url: "ajaxSaveProgram.php",
          data: {
            pname: pname,
            bid: bid,
            nobenefits: nobenefits,
            intendbenefits: intendbenefits,
            mainid: mainid
          },
          cache: false,
          success: function(data) {
            alert(data);
          },
          error: function(xhr, status, error) {
            console.error(xhr);
          }
        });
      }



      //$("select[name='programname']").val('');  
      //$("input[name='noofbenefits']").val('');  
      //$("input[name='intendbenefits']").val('');
    });


    $("body").on("click", ".btn-delete", function() {
      $(this).parents("tr").remove();
    });

    function closeMe() {
      $('#alertbox').hide();
    }
  </script>

</body>

</html>