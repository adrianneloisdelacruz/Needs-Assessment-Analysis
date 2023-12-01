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
$bid = !isset($_REQUEST['bid']) ?"":htmlspecialchars($_REQUEST['bid']);
$style="display:none";
$msg_label = "";
$msg_style = "";
$barangayname = "";
$district = "";
$city = "QUEZON CITY";
$province = "METRO MANILA";
$zone = "";
$region = "NATIONAL CAPITAL REGION";
$contactno = "";

if (isset($_REQUEST['submit'])){
    $barangayname = $_POST['barangayname'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zone = $_POST['zone'];
    $region = $_POST['region'];
    //$contactno = $_POST['contactno'];

      if (strlen($bid)!=0){
          $sql = "SELECT * FROM barangay WHERE barangay_id='".$bid."'";
          $rst = mysqli_query($con, $sql); 

          if (mysqli_num_rows($rst)!=0){
            $sql_update = "UPDATE barangay SET barangay_name='$barangayname',district='$district',zone='$zone',city='$city',province='$province',region='$region' WHERE barangay_id='$bid'";
            $rst = mysqli_query($con, $sql_update);

            $msg_label =  "Record Updated Successfully!";
            $msg_style = "bi-star";
            $style = "";
          }
      }     
  }elseif (strlen($bid)!=0){ //open existing record
  
    $sql = "SELECT * FROM barangay WHERE barangay_id='".$bid."'";
    $rst = mysqli_query($con, $sql);
    
      if (mysqli_num_rows($rst)!=0){
        $row = mysqli_fetch_array($rst);
        $barangayname = $row['barangay_name'];
        $district = $row['district'];
        $city = $row['city'];
        $province = $row['province'];
        $zone = $row['zone'];
        $region = $row['region'];
        $contactno = $row['contact_no'];      
      }  
    }

  if (isset($_POST['submit']) && strlen($bid)==0){ //new record

    $barangayname = $_POST['barangayname'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zone = $_POST['zone'];
    $region = $_POST['region'];
    //$contactno = $_POST['contactno'];

      $sql = "SELECT * FROM barangay WHERE barangay_name LIKE '%$barangayname%'";
      $rst = mysqli_query($con, $sql); 

      if (mysqli_num_rows($rst)!=0){
       $msg_label = "Record Already Exist";
       $msg_style = "bi-exclamation-octagon";
       $style = "";
      }else{

        $sql_insert = "INSERT INTO barangay (barangay_name,zone,district,city,province,region,date_created) 
        VALUES ('$barangayname', '$zone','$district','$city','$province','$region',CURRENT_TIMESTAMP())";
        mysqli_query($con, $sql_insert);
        //$bid = mysqli_insert_id($con);
        $msg_label =  "New record created successfully!";
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
          <li class="breadcrumb-item">Barangay</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style;?>">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Barangay</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post" action="main.php?action=barangayresult">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Barangay Name" name="barangayname" value="<?php echo $barangayname;?>" required>
                    <label for="floatingName">Enter Barangay Name</label>
                  </div>
                </div>
              
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    
                  <select class="form-select" id="floatingSelect" aria-label="District" name="district" required>
                    <option selected>Please Select</option>
                    <option value="district 1" <?php echo $district=='district 1' ? "selected":"";?>>District 1</option>
                    <option value="district 2" <?php echo $district=='district 2' ? "selected":"";?>>District 2</option>
                    <option value="district 3" <?php echo $district=='district 3' ? "selected":"";?>>District 3</option>
                    <option value="district 4" <?php echo $district=='district 4' ? "selected":"";?>>District 4</option>
                    <option value="district 5" <?php echo $district=='district 5' ? "selected":"";?>>District 5</option>
                    <option value="district 6" <?php echo $district=='district 6' ? "selected":"";?>>District 6</option>
                    <option value="district 7" <?php echo $district=='district 7' ? "selected":"";?>>District 7</option>
                    <option value="district 8" <?php echo $district=='district 8' ? "selected":"";?>>District 8</option>
                    <option value="district 9" <?php echo $district=='district 9' ? "selected":"";?>>District 9</option>
                    <option value="district 10" <?php echo $district=='district 10' ? "selected":"";?>>District 10</option>
                    </select>
                    <label for="floatingSelect">District</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingZone" placeholder="Zone" name="zone" value="<?php echo $zone;?>" required>
                      <label for="floatingZone">Zone</label>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingCity" placeholder="City" name="city" value="<?php echo $city;?>" required>
                    <label for="floatingCity">City</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingCity" placeholder="Province" name="province" value="<?php echo $province;?>" required>
                    <label for="floatingCity">Province</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingCity" placeholder="Region" name="region" value="<?php echo $region;?>" required>
                    <label for="floatingCity">Region</label>
                  </div>
                </div>
                <div class="text-center">
                  <input type="hidden" name="bid" value="<?php echo (isset($_REQUEST['bid'])) ? $_REQUEST['bid']:"";?>">
                  <input type="submit" class="btn btn-primary" name="submit" value="Save">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                  <a href="main.php?action=barangaylist"><button type="button" class="btn btn-warning">Back</button></a>

                </div>
              </form><!-- End floating Labels Form -->

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