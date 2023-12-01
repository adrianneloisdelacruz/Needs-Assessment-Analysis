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

  $projectid = "";
  $barangayid = "";

  if (isset($_REQUEST['stat'])) {
    $recoid = $_REQUEST['recoid'];
    $stat = $_REQUEST['stat']; //	0=create,1=ongoing,2=done
    $update_sql = "UPDATE needs_assessement_recommendation SET status='$stat' WHERE reco_id='$recoid'";
    $rst = mysqli_query($con, $update_sql);

    if (mysqli_query($con, $update_sql)) {
      //$msg_label =  "Status updated successfully!";
      //$msg_style = "bi-star";
      //$style = "";
    } else {
      //$msg_label =  "Error: " . $update_sql . "<br>" . mysqli_error($con);
      //$msg_style = "alert-warning";
      //$style = "";
    }
  }
  ?>

  </header><!-- End Header -->
  <div class="pagetitle">
    <h1 align="center"></h1>
    <nav>
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item"><a>Enter Project Title</a></li> -->
        <li class="breadcrumb-item">Project Evaluation</li>
      </ol>
    </nav>
  </div> <!-- End Page Title -->

  <section class="section">
    <form class="row g-3" action="main.php?action=projectEvaluationList" method="post">
      <?php
      $sql = "SELECT * FROM barangay ORDER BY district,barangay_name";
      $result = mysqli_query($con, $sql);

      ?>

      <div class="col-md-4">
        <!--  <label for="inputEmail5" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail5"> -->
        <label for="inputBarangay" class="form-label">Select Barangay</label>
        <select id="inputBarangay" class="form-select" name="barangayid">
          <option value='0' selected>Choose...</option>
          <?php while ($row = mysqli_fetch_array($result)) {
            $sel = $row['barangay_id'] == $barangayid ? "Selected" : "";
            echo "<option value='" . $row['barangay_id'] . "' $sel>" . strtoupper($row['barangay_name']) . "-Zone:" . $row['zone'] . "</option>";
          } ?>
        </select>
      </div>
      <div class="col-md-4">
        <?php
        $sql = "SELECT * FROM project ORDER BY project_title";
        $result = mysqli_query($con, $sql);

        ?>
        <label for="inputZone" class="form-label">Select Project</label>
        <select id="inputZone" class="form-select" name="projectid">
          <option value='0' selected>Choose...</option>
          <?php while ($row = mysqli_fetch_array($result)) {
            $sel = $row['project_id'] == $projectid ? "Selected" : "";
            echo "<option value='" . $row['project_id'] . "' $sel>" . strtoupper($row['project_title']) . "</option>";
          } ?>
        </select>
      </div>

      <div class="text-left">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
      <hr>

    </form>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>

          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Result:</h5>

                <!-- Table with stripped rows -->
                <table class="table table-bordered">
                  <thead>
                    <tr>

                      <th scope="col">Project Title</th>
                      <th scope="col">Target Beneficiaries</th>
                      <th scope="col">Actual Beneficiaries</th>
                      <th scope="col">Baranggay</th>
                      <th scope="col">Status</th>
                      <th scope="col">Date Created</th>
                      <td align="center">Action</td>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $cond = "";
                    if (isset($_POST['barangayid']) && $_POST['barangayid'] != 0) {
                      $queryString1 = $_POST['barangayid'];
                      $cond = " WHERE barangay_id = '" . $queryString1 . "'";
                    }
                    if (isset($_POST['projectid']) && $_POST['projectid'] != 0) {
                      $queryString = $_POST['projectid'];
                      $cond = " WHERE project_id = '" . $queryString . "'";
                    } else {
                      $cond = "WHERE project_id!=0";
                    }
                    if ((isset($_POST['barangayid']) && $_POST['barangayid'] != 0) && (isset($_POST['projectid']) && $_POST['projectid'] != 0)) {
                      $queryString = $_POST['projectid'];
                      $queryString1 = $_POST['barangayid'];
                      $cond = " WHERE project_id = '" . $queryString . "' AND barangay_id = '" . $queryString1 . "' ";
                    }

                    $cond .= " LIMIT 100";

                    $sql = "SELECT * FROM needs_assessement_recommendation $cond"; //project $cond"; 
                    $rst = mysqli_query($con, $sql);

                    // $sql = "SELECT p.project_id, p.project_title, p.course_category,b.project_beneficiary_target,b.project_beneficiary_actual FROM project p INNER 
                    //JOIN project_beneficiaries b ON p.project_id = b.project_id ";
                    //$rst = mysqli_query($con, $sql);

                    if (mysqli_num_rows($rst) != 0) {

                      while ($row = mysqli_fetch_array($rst)) {
                        $id = $row['project_id'];
                        $recoid = $row['reco_id'];
                        $barangay_id = $row['barangay_id'];
                        $stat = $row['status'];
                        if ($row['status'] == '1') {
                          $status =  "On-Going";
                        } elseif ($row['status'] == '2') {
                          $status =  "Completed";
                        } else {
                          $status = "Created";
                        }
                        echo "<tr>";
                        echo "<td>" . strtoupper(selectProject($row['project_id'])) . "</td>";
                        echo "<td align='center'>" . $row['target_beneficiaries'] . "</td>";
                        echo "<td align='center'>" . $row['actual_beneficiaries'] . "</td>";
                        echo "<td>" . selectBarangay($row['barangay_id']) . "</td>";
                        echo "<td>" . $status . "</td>"; //	0=create,1=ongoing,2=done	 
                        echo "<td>" . $row['date_created'] . "</td>";
                        echo "<td><a href='main.php?action=projectEvalres&proid=$id&recoid=$recoid&bid=$barangay_id'><button type='button' class='btn btn-outline-success' >View/Edit Record</button></a>";
                        echo " | <a href='main.php?action=projectEval&id=$id&recoid=$recoid&bid=$barangay_id'><button type='button' class='btn btn-outline-danger' >Download Evaluation Form</button></a>";
                        echo " | <button type='button' class='btn btn-outline-warning' data-bs-toggle='modal' data-bs-target='#verticalycentered' data-recoid='$recoid'>Update</button></td>";
                    ?>

                        <!--  Vertically centered Modal-->

                        <div class="modal fade" id="verticalycentered" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                              <div class="modal-header">
                                <h5 class="modal-title">Update Project Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                              <form id="evalForm" name="evalForm" role="form" action="main.php?action=projectEvaluationList" method="post">
                                <div class="modal-body">

                                  <div class="row mb-6">
                                    <div class="col-sm-10">
                                      <select class="form-select" aria-label="Default select example" name="stat" id="stat">
                                        <option value="0" <?php echo $stat == 0 ? 'selected' : ''; ?>>Created</option>
                                        <option value="1" <?php echo $stat == 1 ? 'selected' : ''; ?>>On-going</option>
                                        <option value="2" <?php echo $stat == 2 ? 'selected' : ''; ?>>Completed</option>
                                      </select>
                                    </div>
                                  </div>


                                </div>

                                <div class="modal-footer">
                                  <input type="hidden" name="recoid" value="<?php echo $recoid ?>">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" name="savedata">Save Changes</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div><!-- End Vertically centered Modal-->



                    <?php
                        echo "</tr>";
                      }
                    }
                    ?>


                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
                <!--
              <div class="text-center"> 
              <a href="main.php?action=existingProject&tag=new"><button type="button" class="btn btn-primary">Add New Project</button></a>
              </div>
                      -->

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript">

  </script>

</body>

</html>