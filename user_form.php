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
$uid = !isset($_REQUEST['uid']) ? "":htmlspecialchars($_REQUEST['uid']); //user id 
$tag_stat = isset($_REQUEST['tag']) && $_REQUEST['tag'] =='new' ? "Create":"Edit"; //tag
$tag = isset($_REQUEST['tag']) && $_REQUEST['tag'] =='new' ? "new":"edit"; //tag

$style="display:none";
$msg_label = "";
$msg_style = "";
$firstname = "";
$lastname = "";
$role = "";
$barangay = "";
$email = "";
$username = "";
$userpass = "";


if (isset($_REQUEST['tag']) && $_REQUEST['tag']=='new'){

  if (isset($_REQUEST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    $barangay = $_POST['barangay'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $userpass = $_POST['passwordx'];

      $sql = "SELECT * FROM users WHERE username='$username' AND userpass='$userpass'";
      $rst = mysqli_query($con, $sql); 

      if (mysqli_num_rows($rst)!=0){
        $msg_label = "Record Already Exist! Please check your username/password";
        $msg_style = "bi-exclamation-octagon";
        $style = "";
      }else{

        $sql_insert = "INSERT INTO users (user_firstname,user_lastname,username,userpass,user_role,barangay,email,date_created) 
        VALUES ('$firstname', '$lastname','$username','$userpass','$role','$barangay','$email',CURRENT_TIMESTAMP())";
        mysqli_query($con, $sql_insert);
        $uid = mysqli_insert_id($con);
        $msg_label =  "New record created successfully!";
        $msg_style = "bi-star";
        $style = "";
      }  
  }

}  

if (isset($_REQUEST['tag']) && $_REQUEST['tag']=='edit'){
    
   $sql = "SELECT * FROM users  WHERE user_id='".$uid."'";
    $rst = mysqli_query($con, $sql);
    
      if (mysqli_num_rows($rst)!=0){
        $row = mysqli_fetch_array($rst);
        $firstname = $row['user_firstname'];
        $lastname = $row['user_lastname'];
        $username = $row['username'];
        $userpass = $row['userpass'];
        $role = $row['user_role'];
        $barangay = $row['barangay'];
        $email = $row['email'];      
      }

    if (isset($_REQUEST['submit'])){
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $role = $_POST['role'];
      $barangay = $_POST['barangay'];
      $email = $_POST['email'];
      $username = $_POST['username'];
      $userpass = $_POST['passwordx'];

          if (strlen($uid)!=0){
              $sql = "SELECT * FROM users WHERE user_id='".$uid."'";
              $rst = mysqli_query($con, $sql); 

              if (mysqli_num_rows($rst)!=0){
                $sql_update = "UPDATE users SET user_firstname='$firstname',user_lastname='$lastname',role='$role',barangay='$barangay',email='$email',
                                username='$username',userpass='$userpass' WHERE user_id='$uid'";
                $rst = mysqli_query($con, $sql_update);

                $msg_label =  "Record Updated Successfully!";
                $msg_style = "bi-star";
                $style = "";
              }
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
          <li class="breadcrumb-item">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style;?>">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
    <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"><?php echo $tag_stat; ?> an Account</h5>
                    <p class="text-center small">Enter user details</p>
                  </div>

                  <form method="post" action="main.php?action=userform"class="row g-3 needs-validation" novalidate>
                    <div class="col-6">
                      <label for="yourName" class="form-label">First Name</label>
                      <input type="text" name="firstname" class="form-control" id="yourName" value="<?php echo $firstname?>" required>
                      <div class="invalid-feedback">Please, enter Firstname!</div>
                    </div>

                    <div class="col-6">
                      <label for="yourName" class="form-label">Last Name</label>
                      <input type="text" name="lastname" class="form-control" id="yourName" value="<?php echo $lastname?>" required>
                      <div class="invalid-feedback">Please, enter Lastname!</div>
                    </div>
                    <?php    
        
                        $query1 = "SELECT role_id,role_name FROM role";
                        $rst1 = mysqli_query($con, $query1);
        
                     ?>    

                    <div class="col-6">
                      <label for="yourRole" class="form-label">Role</label>
                      <select class="form-select" aria-label="Default select example" name="role" required>
                      <option>Please select user role...</option>
                        <?php while ( $row1 = mysqli_fetch_assoc($rst1) ) {
                        $role_name = $row1['role_name'];
                        $role_id = $row1['role_id'];
                        $sel = (isset($_POST['role']) && $_POST['role']==$role_id) ? "selected":"";
                        ?>  
                        
                        <option value="<?php echo $role_id;?>" <?php echo $sel?>><?php echo $role_name;?></option>

                      <?php } ?>  
                      </select>
                      
                    </div>
                    <?php    
        
                        $query2 = "SELECT barangay_id,barangay_name FROM barangay";
                        $rst2 = mysqli_query($con, $query2);
        
                     ?>      
                    <div class="col-6">
                      <label for="yourBarangay" class="form-label">Barangay</label>
                      <select class="form-select" aria-label="Default select example" name="barangay" required>
                      <option >Please select Barangay...</option>
                        <?php while ( $row2 = mysqli_fetch_assoc($rst2) ) {
                        $barangay_name = $row2['barangay_name'];
                        $barangay_id = $row2['barangay_id'];
                        $sel = (isset($_POST['barangay']) && $_POST['barangay']==$barangay_id) ? "selected":"";
                        ?>  
                        
                        <option value="<?php echo $barangay_id;?>" <?php echo $sel?>><?php echo $barangay_name;?></option>

                      <?php } ?>  
                      </select>
                      
                    </div>

                    <div class="col-4">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" value="<?php echo $email?>" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-4">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" value="<?php echo $username?>" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-4">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="passwordx" class="form-control" id="yourPassword" value="<?php echo $userpass?>" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    
                    
                    <!-- 
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
-->                 
                <div align="center" class="col-12">        
                    <div class="col-3">
                      <input type="hidden" name="tag" value="<?php echo $tag?>">
                      <input type="hidden" name="uid" value="<?php echo $uid?>">
                      <button class="btn btn-primary" type="submit" name="submit">Save Account</button>
                      <a href="main.php?action=userlist">    
                      <button class="btn btn-primary" type="button">Back to List</button>
                        </a>
                    </div>
                        </div>          
                    <!-- <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="pages-login.html">Log in</a></p>
                    </div> -->
                  </form>

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