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
  $style = "display:none";
  $msg_label = "";
  $msg_style = "";
  $family_name = "";
  $first_name = "";
  $address = "";
  $city = "";
  $barangay = "";
  $contact_no = "";
  $email = "";
  $birth_date = "";
  $ageinlast_birthday = "";

  //Section A
  if (isset($_POST['familyname']) && $_POST['familyname'] != NULL) {
    $family_name = $_POST['familyname'];
    $first_name = $_POST['firstname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $contact_no = $_POST['contactno'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $ageinlast_birthday = $_POST['ageinlast_birthday'];

    $sql = "SELECT * FROM assessment_main_info WHERE assessment_id='" . $main_id . "'";
    $rst = mysqli_query($con, $sql);

    if (mysqli_num_rows($rst) == 0) {
      $sql = "INSERT INTO assessment_main_info (assessment_id,	family_name,first_name,home_address,city,barangay,contact_no,email,birthdate,ageinlastbirthday,date_created) 
    VALUES ('', '$family_name', '$first_name','$address','$city','$barangay','$contact_no','$email','$birth_date','$ageinlast_birthday',CURRENT_TIMESTAMP())";
      if (mysqli_query($con, $sql)) {
        //$main_id = LAST_INSERT_ID($sql);
        $main_id = mysqli_insert_id($con);

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
  <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style; ?>">
    <i class="bi <?php echo $msg_style; ?> me-1"></i>
    <?php echo $msg_label ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <section class="section">
    <div class="row">
      <div class="card">
        <div class="card-body">

          <!-- Multi Columns Form -->
          <!--  -------------------- 1st tab section A ------------------------------------------------- -->
          <form method="post" class="row g-3" id="formA" name="formA" action="main.php?action=needsassessmentA">
            <h5 class="card-title">Section A - Indentification </h5>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">Family Name</label>
              <input type="text" class="form-control" id="inputName5" name="familyname" value="<?php echo $family_name; ?>" required>
            </div>
            <div class="col-md-6">
              <label for="inputName5" class="form-label">First Name</label>
              <input type="text" class="form-control" id="inputName5" name="firstname" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="col-12">
              <label for="inputAddress5" class="form-label">Address (House No.& Street)</label>
              <input type="text" class="form-control" id="inputAddres5s" name="address" placeholder="1234 Main St" value="<?php echo $address; ?>" required>
            </div>
            <div class="col-md-6">
              <label for="inputCity" class="form-label">City</label>
              <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $city; ?>" required>
            </div>
            <!--<div class="col-md-4">
                  <label for="inputState" class="form-label">Region</label>
                  <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div> -->
            <?php

            $query2 = "SELECT barangay_id,barangay_name FROM barangay";
            $rst2 = mysqli_query($con, $query2);

            ?>

            <div class="col-md-6">
              <label for="inputBarangay" class="form-label">Barangay</label>
              <select class="form-select" aria-label="Default select example" name="barangay" required>
                <option></option>
                <?php while ($row2 = mysqli_fetch_assoc($rst2)) {
                  $barangay_name = $row2['barangay_name'];
                  $barangay_id = $row2['barangay_id'];
                  $sel = (isset($_POST['barangay']) && $_POST['barangay'] == $barangay_id) ? "selected" : "";
                ?>

                  <option value="<?php echo $barangay_id; ?>" <?php echo $sel ?>><?php echo $barangay_name; ?></option>

                <?php } ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="inputBirth1" class="form-label">Date of Birth</label>
              <input type="date" class="form-control" id="inputBirth" name="birth_date" value="<?php echo $birth_date; ?>" required>
            </div>
            <div class="col-md-6">
              <label for="inputAge" class="form-label">Age (In your last Birthday)</label>
              <input type="text" class="form-control" id="inputAge" name="ageinlast_birthday" value="<?php echo $ageinlast_birthday; ?>" required>
            </div>

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Contact Number</label>
              <input type="text" class="form-control" id="inputContact" name="contactno" value="<?php echo $contact_no; ?>" required>
            </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Email</label>
              <input type="email" class="form-control" id="inputEmail5" name="email" value="<?php echo $email; ?>">
            </div>

            <div class="text-center">
              <input type="hidden" name="main_id" value="<?= $main_id ?>">
              <input type="hidden" name="bid" value="<?= $barangay ?>">
              <button type="submit" class="btn btn-primary" name="saveA" id="saveA">Save Section A</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
              <a href="main.php?action=needsassessmentB&main_id=<?= $main_id ?>&bid=<?php echo $barangay ?>"><button type="button" class="btn btn-warning" id="nextpageB">Next Page -> Section B</button></a>

            </div>
          </form><!-- End Multi Columns FormA -->
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
    /*
 	$(window).on("beforeunload", function() {
			return "Are you sure? You didn't finish the form!";
		});
		
		$(document).ready(function() {
			$("#formB").on("submit", function(e) {
				//check form to make sure it is kosher
				//remove the ev
				$(window).off("beforeunload");
				return true;
			});
		});
*/
    $(document).ready(function() {

      $("#inputBirth").on('change', function() {
        // alert("pasok");
        var dob1 = $("#inputBirth").val();
        var inputBirth = $.datepicker.formatDate('yy-mm-dd', new Date(dob1));
        var str = inputBirth.split('-');
        var firstdate = new Date(str[0], str[1], str[2]);
        var today = new Date();
        var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
        var age = parseInt(dayDiff);
        // alert(dob1);
        $("#inputAge").val(age);

      });
    });
    $("#nextpageB").click(function() {
      alert("Please make sure you have save this section!");
      $("#formB").show();
      $("#formA").hide();
      $("#formC").hide();
      $("#formE").hide();
    });
    $("#nextpageC").click(function() {
      $("#formB").hide();
      $("#formA").hide();
      $("#formC").show();
      $("#formE").hide();
    });
    $("#nextpageE").click(function() {
      $("#formB").hide();
      $("#formA").hide();
      $("#formC").hide();
      $("#formE").show();
    });
    $("#nextpageA").click(function() {
      $("#formB").hide();
      $("#formA").show();
      $("#formC").hide();
      $("#formE").hide();
    });

    $("#saveB").on("click", function() {
      //e.preventDefault();  
      $("#formB").show();
      $("#formA").hide();
      $("#formC").hide();
      $("#formE").hide();

    });

    $("#saveC").on("click", function() {
      //e.preventDefault();  
      $("#formB").hide();
      $("#formA").hide();
      $("#formC").show();
      $("#formE").hide();

    });
    $("#recostat").on("click", function() {
      //e.preventDefault();  
      $("#recommendation").show();
      $("#formA").hide();
      $("#formC").hide();
      $("#formE").hide();
      $("#formB").hide();

    });
    $("#saveA").on("click", function() {
      $('#nextpageB').prop('disabled', false);
    });

    $("#savebtn").on("click", function(e) {
      e.preventDefault();
      var pname = $("input[name='programname']").val();
      var nobenefits = $("input[name='noofbenefits']").val();
      var intendbenefits = $("input[name='intendbenefits']").val();


      // $(".data-table tbody").append("<tr data-programname='"+pname+"' data-noofbenefits='"+nobenefits+"' data-intendbenefits='"+intendbenefits+"'><td>"+pname+"</td><td>"+nobenefits+"</td><td>"+intendbenefits+"</td><td><button class='btn btn-danger btn-xs btn-delete'align='center'>Delete</button></td></tr>");  

      //$("input[name='programname']").val('');  
      //$("input[name='noofbenefits']").val('');  
      //$("input[name='intendbenefits']").val('');
    });

    //$("body").on("click", ".btn-delete", function(){  
    //   $(this).parents("tr").remove();  
    //});   

    function closeMe() {
      $('#alertbox').hide();
    }

    /*  
    $("body").on("click", ".btn-edit", function(){  
        var programname = $(this).parents("tr").attr('data-programname');  
        var noofbenefits = $(this).parents("tr").attr('data-noofbenefits');  
        var intendbenefits = $(this).parents("tr").attr('data-intendbenefits');
      
        $(this).parents("tr").find("td:eq(0)").html('<input name="edit_programname" value="'+programname+'">');  
        $(this).parents("tr").find("td:eq(1)").html('<input name="edit_noofbenefits" value="'+noofbenefits+'">');  
        $(this).parents("tr").find("td:eq(2)").html('<input name="edit_intendbenefits" value="'+intendbenefits+'">');  

        $(this).parents("tr").find("td:eq(3)").prepend("<button class='btn btn-info btn-xs btn-update'>Update</button><button class='btn btn-warning btn-xs btn-cancel'>Cancel</button>")  
        $(this).hide();  
    });  
     
    $("body").on("click", ".btn-cancel", function(){  
        var name = $(this).parents("tr").attr('data-name');  
        var email = $(this).parents("tr").attr('data-email');  
      
        $(this).parents("tr").find("td:eq(0)").text(name);  
        $(this).parents("tr").find("td:eq(1)").text(email);  
     
        $(this).parents("tr").find(".btn-edit").show();  
        $(this).parents("tr").find(".btn-update").remove();  
        $(this).parents("tr").find(".btn-cancel").remove();  
    });  
     
    $("body").on("click", ".btn-update", function(){  
        var name = $(this).parents("tr").find("input[name='edit_name']").val();  
        var email = $(this).parents("tr").find("input[name='edit_email']").val();  
      
        $(this).parents("tr").find("td:eq(0)").text(name);  
        $(this).parents("tr").find("td:eq(1)").text(email);  
       
        $(this).parents("tr").attr('data-name', name);  
        $(this).parents("tr").attr('data-email', email);  
      
        $(this).parents("tr").find(".btn-edit").show();  
        $(this).parents("tr").find(".btn-cancel").remove();  
        $(this).parents("tr").find(".btn-update").remove();  
    });  
 */
  </script>

</body>

</html>