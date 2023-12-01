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
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="main.php?action=extensionProjectList">
        <input type="text" name="queryString" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
      </nav>
    <div class="pagetitle">
      <h1 align="center"></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Enter Project Title</a></li>
          <!-- <li class="breadcrumb-item">Needs Assessment Form</li> -->
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
              <h5 class="card-title">Result:</h5>

              <!-- Table with stripped rows -->
              <table class="table table-bordered">
                <thead>
                  <tr align="center">
                    <th scope="col">Project Title</th>
                    <th scope="col">Extension Project Count</th>
                    <!-- <th scope="col">Existing Project Count</th>-->
                    <th scope="col">Category(Course)</th>
                    <!-- <th scope="col">Date Implemented</th>
                    <th scope="col">Evaluation Rate</th>
                    <th scope="col">Barangay</th>-->
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $cond = "";
                  
                    if (isset($_POST['queryString'])){
                      $queryString = $_POST['queryString'];
                      $cond .= " WHERE p.project_title RLIKE '".$queryString."'";
                    }  
                        
                        //$sql = "SELECT * FROM project $cond"; WHERE p.project_id='".$project_id."'
                        //$rst = mysqli_query($con, $sql); 
                        $sql = "SELECT p.project_id, p.project_title, p.course_category,b.project_beneficiary_target,b.project_beneficiary_actual FROM project p INNER 
                        JOIN project_beneficiaries b ON p.project_id = b.project_id $cond";
                        $rst = mysqli_query($con, $sql);

                        if (mysqli_num_rows($rst)!=0){
                    
                            while($row = mysqli_fetch_array($rst)){
                                $id = $row['project_id'];
                                echo "<tr align='center'>";
                                   
                                    echo "<td>" . strtoupper($row['project_title']) ."</td>";
                                    echo "<td>" . extensionProjCnt($row['project_id']) ."</td>";
                                    echo "<td>" . strtoupper(selectCourse($row['course_category'])) ."</td>";
                                   
                                    echo "<td><a href='main.php?action=extensionProject2&pid=$id'><button type='button' class='btn btn-outline-success' >View/Edit Record</button></a></td>";
                                echo "</tr>";
                            }
                        }else{ 
                            echo "<tr>";
                            echo "<td>No Record Found!vcvc</td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            //echo "<td></td>";
                            //echo "<td></td>";
                            //echo "<td></td>";
                            echo "</tr>";
                        }
                    
                ?>    
                 
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

              <div class="text-center"> 
              <!-- <a href="main.php?action=extensionProject&tag=new"><button type="button" class="btn btn-primary">Add Extension Project</button></a> -->
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

</script>  

</body>

</html>