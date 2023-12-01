<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
?>
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

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <?php
  include("config/connect.php");
  require_once "function.php";
  //var_dump($_POST);
  // Make sure the submitted registration values are not empty.

  if (!isset($_SESSION['userName'])) {
    $user_name = $_POST['username'];
    $user_pass = $_POST['password'];
    $sql_chkuser = "SELECT * FROM users WHERE username='$user_name' AND userpass='$user_pass'";
    $result = mysqli_query($con, $sql_chkuser);
    if (mysqli_num_rows($result) != 0) {
      $row = mysqli_fetch_array($result);
      $_SESSION['userName'] = $user_name;
      $_SESSION['userPass'] = $user_pass;
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['userRole'] = $row['user_role'];
      header("Location: ?action=dashboard");
    } else {
      $msg = "User Does Not Exist";
      //header("Location: localhost:8080/naaac/login.php"); 
  ?>
      <script>
        alert("Invalid Login");
      </script>
      <script>
        window.location = "index.php";
      </script>

      <!-- <meta http-equiv="refresh" content="0;url=localhost:8080/naaac/login.php"/>
        exit; -->
  <?php  }
  }
  ?>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="pages/dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NAAAC</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <h5 align="center">Needs Assessment Analysis in Adapted Community of College of Arts and Sciences using Content-Based Filtering Algorithm</h5>
      <!-- <h6 align="right"<a>Sign out</a></h6> -->
    </div>



  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="main.php?action=dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <?php if ($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2' || $_SESSION['userRole'] == '4' || $_SESSION['userRole'] == '5') { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>

          <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="main.php?action=needsassessmentA">
                <i class="bi bi-circle"></i><span>New Assessment</span>
              </a>
            </li>
            <li>
              <a href="main.php?action=needsassessment2">
                <i class="bi bi-circle"></i><span>Needs Assessment</span>
              </a>
            </li>
            <!-- <li>
            <a href="main.php?action=needsassessmentArchived">
              <i class="bi bi-circle"></i><span>Archived Record</span>
            </a>
          </li> -->

          </ul>
        <?php } ?>
        </li><!-- End Forms Nav -->

        <?php if ($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2' || $_SESSION['userRole'] == '3') { ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">
              <i class="bi bi-journal-text"></i><span>Evaluations</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="main.php?action=needsassessmentArchived">
                  <i class="bi bi-circle"></i><span>New Assessment Records</span>
                </a>
              </li>
              <li>
                <a href="main.php?action=projectEvaluationList">
                  <i class="bi bi-circle"></i><span>Projects Evaluation</span>
                </a>
              </li>
              <li>
                <a href="main.php?action=extensionProjectList">
                  <i class="bi bi-circle"></i><span>Extension Projects</span>
                </a>
              </li>

            </ul>
          </li><!-- End Forms Nav -->
        <?php } ?>

        <!-- start admin Nav -->
        <?php if ($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2') { ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav2" data-bs-toggle="collapse" href="#">
              <i class="bi bi-journal-text"></i><span>Manage Admin</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="main.php?action=projectlist">
                  <i class="bi bi-circle"></i><span>Projects</span>
                </a>
              </li>
              <li>
                <a href="main.php?action=programlist">
                  <i class="bi bi-circle"></i><span>Program</span>
                </a>
              </li>
              <li>
                <a href="main.php?action=barangaylist">
                  <i class="bi bi-circle"></i><span>Barangay</span>
                </a>
              </li>
              <li>
                <a href="main.php?action=schedulelist">
                  <i class="bi bi-circle"></i><span>Program Schedule</span>
                </a>
              </li>
              <li>
                <a href="main.php?action=userlist">
                  <i class="bi bi-circle"></i><span>Users</span>
                </a>
              </li>
            </ul>
          </li><!-- End Admin Nav -->
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link " href="index.php">
            <i class="bi bi-grid"></i>
            <span>Logout</span>
          </a>
        </li><!-- End Dashboard Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <?php
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
      header('Location: index.php');
      exit;
    }

    if (isset($_REQUEST['action'])) {

      switch ($_REQUEST['action']) {
        case "needsassessmentA":
          include("./pages/needs_assessment_a.php");
          break;

        case "needsassessmentB":

          if (isset($_POST['namehouseholdhead']) && $_POST['namehouseholdhead'] != NULL) {
            $mainID = htmlspecialchars($_REQUEST['main_id']);
            $name_household_head = $_POST['namehouseholdhead'];
            $relationship_household_head = $_POST['relationshiphouseholdhead'];
            $gender = $_POST['gender'];
            $birthdate = $_POST['birthdate'];
            $age_in_lastbirthday = $_POST['ageinlastbirthday'];
            $still_studying = $_POST['stillstudying'];
            $religion = $_POST['religion'];
            $education = $_POST['education'];
            $marital_status = $_POST['maritalstatus'];
            $primary_sourceincome = $_POST['primarysourceincome'];
            //$primary_sourceincome1 = $_POST['primarysourceincome1'];
            $regular_income = $_POST['regularincome'];
            $work_skills = $_POST['workskills'];
            //$work_skills1il = $_POST['workskills1'];
            $monthly_income = $_POST['monthlyincome'];
            $philhealth = $_POST['philhealth'];
            $election = $_POST['election'];
            $taxpayer = $_POST['taxpayer'];
            $mobileno = $_POST['mobileno'];

            $sqlB = "SELECT assessment_id FROM assessment_main_info WHERE assessment_id={$mainID}";
            $rstB = mysqli_query($con, $sqlB);

            if (mysqli_num_rows($rstB) > 0) {

              /* $sql_update = "UPDATE assessment_main_info SET 
                  namehouseholdhead='$name_household_head', 
                  relationshiphouseholdhead='$relationship_household_head',
                  gender='$gender',
                  birthdate='$birthdate',
                  ageinlastbirthday='$age_in_lastbirthday',
                  stillstudying='$still_studying',
                  religion='$religion',
                  maritalstatus ='$marital_status',
                  education = '$education',
                  primarysourceincome ='$primary_sourceincome',
                  regularincome ='$regular_income',
                  workskills ='$work_skills',
                  monthlyincome ='$monthly_income',,
                  philhealth ='$philhealth',
                  election ='$election',
                  taxpayer ='$taxpayer',
                  mobileno ='$mobileno',
                  date_modified = CURRENT_TIMESTAMP() 
                  WHERE assessment_id={$mainID}"; */

              $sql_insert = "INSERT INTO household_members(household_name,relationshiip_household_head,gender, birthdate ,age_last_birthday,still_studying,religion,marital_status,education,primary_income,regular_income,work_skills,monthly_income,philhealth,election,tax_payer,mobile_no,assessment_id,date_created)
                                VALUES('$name_household_head','$relationship_household_head','$gender','$birthdate','$age_in_lastbirthday','$still_studying','$religion','$marital_status','$education','$primary_sourceincome','$regular_income','$work_skills','$monthly_income','$philhealth','$election','$taxpayer','$mobileno','$mainID',CURRENT_TIMESTAMP)";

              if (mysqli_query($con, $sql_insert)) {
                $msg_label =  "Record Added Successfully!";
                $msg_style = "bi-star";
              } else {
                $msg_label =  "Error: " . $sql_insert . "<br>" . mysqli_error($con);
                $msg_style = "alert-warning";
              }
            }
          }
          include("./pages/needs_assessment_b.php");
          break;

        case "needsassessmentC":

          include("./pages/needs_assessment_c.php");
          break;

        case "needsassessmentE":
          include("./pages/needs_assessment_e.php");
          break;

        case "recommendation":
          include("./pages/recommendation.php");
          break;

        case "needsassessmentArchived":
          include("./pages/archived_list.php");
          break;

        case "needsassessmentArchivedresult":
          include("./pages/needs_assessment_archived.php");
          break;

        case "projectlist":
          include("./pages/project_list.php");
          break;

        case "projectlistresult":
          include("./pages/project.php");
          break;

        case "programlist":
          include("./pages/program_list.php");
          break;

        case "programlistresult":
          include("./pages/program.php");
          break;

        case "schedulelist":
          include("schedule_list.php");
          break;

        case "schedulelist2":
          include("schedule_list2.php");
          break;

        case "scheduleform":
          include("schedule_form.php");
          break;

        case "barangaylist":
          include("barangay_list.php");
          break;

        case "barangayresult":
          include("barangay_form.php");
          break;


        case "needsassessment2":
          include("needs_assessment2.php");
          break;

        case "needsassessment2reco":
          include("needs_assessment2_reco.php");
          break;

        case "needsassessment2reco2":
          include("needs_assessment2_reco2.php");
          break;

        case "userlist":
          include("user_list.php");
          break;

        case "userform":
          include("user_form.php");
          break;

        case "existingProjectList":
          include("existingProjectList.php");
          break;

        case "existingProject":
          include("existingProject.php");
          break;

        case "projectEvaluationList":
          include("projectEvaluationlist.php");
          break;

        case "projectEvalres":
          include("projectEvaluationresult.php");
          break;

        case "projectEval":
          include("generateEvaluation.php");
          break;




          case "needsassessment2proposal":
          include("generateProposal.php");
          break;

          case "needsassessment2proposalbsap":
          include("generateProposalbsap.php");
          break;

          case "needsassessment2proposalbsp":
          include("generateProposalbsp.php");
          break;

          case "needsassessment2proposalbsmath":
          include("generateProposalbsmath.php");
          break;

          case "needsassessment2proposalbscs":
          include("generateProposalbscs.php");
          break;





        case "dashboard":
          include("./pages/dashboard.php");
          break;

        case "extensionProjectList":
          include("extensionProjectList.php");
          break;

        case "extensionProject2":
          include("extensionProjectList2.php");
          break;

        case "extensionProject":
          include("extensionProject.php");
          break;

        case "logout":
          include("index.php");
          break;
      }
    }
    ?>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; EARIST MANILA Copyright <strong><span></span></strong>. All Rights Reserved 2023
    </div>

  </footer><!-- End Footer -->
 
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

</body>

</html>