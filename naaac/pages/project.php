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
$project_id = !isset($_REQUEST['id']) ?"":htmlspecialchars($_REQUEST['id']);
$tag = !isset($_REQUEST['tag']) ?"":htmlspecialchars($_REQUEST['tag']);
$style="display:none";
$msg_label = "";
$msg_style = "";
$projecttitle = "";
$projectdesc = "";
$dateimplemented = "";
$courseid = "";
$barangay = "";
$targetbeneficiaries = "";
$actualbeneficiaries = "";
$strkeyword = "";
if (strlen($project_id)!=0){
  $sql = "SELECT * FROM project WHERE project_id='".$project_id."'";
  $rst = mysqli_query($con, $sql); 

//$sql = "SELECT p.project_id, p.project_title, p.course_category,b.project_beneficiary_target,b.project_beneficiary_actual FROM project p INNER 
//JOIN project_beneficiaries b ON p.project_id = b.project_id WHERE p.project_id='".$project_id."'";
//$rst = mysqli_query($con, $sql);

  if (mysqli_num_rows($rst)!=0){
    $row = mysqli_fetch_array($rst);
    $projecttitle = $row['project_title'];
    $courseid = $row['course_category'];
    $strkeyword = $row['string_keyword'];
   // $sql2 = " SELECT * FROM `project_beneficiaries` WHERE project_id='".$project_id."'";
    //if (mysqli_num_rows($rs)!=0){
      //$row2 = mysqli_fetch_array($rs);
     // $targetbeneficiaries = $row['project_beneficiary_target'];
      //$actualbeneficiaries = $row['project_beneficiary_actual'];  
      
  }  
}
//var_dump($_POST);
if (isset($_REQUEST['submit']) && $tag='edit'){
  $projecttitle = $_POST['projecttitle'];
  //$projectdesc = $_POST['projectdesc'];
  //$dateimplemented = $_POST['dateimplemented'];
  $courseid = $_POST['courseid'];
  $strkeyword = $_POST['strkeyword'];

 // $barangay = $_POST['barangay'];
  //$targetbeneficiaries = $_POST['targetbeneficiaries'];
  //$actualbeneficiaries = $_POST['actualbeneficiaries'];

  
  if (strlen($project_id)!=0){
      $sql = "SELECT * FROM project WHERE project_id='".$project_id."'";
      $rst = mysqli_query($con, $sql); 

      if (mysqli_num_rows($rst)!=0){
        $sql_update = "UPDATE project SET project_title='$projecttitle',course_category='$courseid',string_keyword='$strkeyword',date_modified=CURRENT_TIMESTAMP WHERE project_id='$project_id'";
        $rst = mysqli_query($con, $sql_update);
        $msg_label =  "Record updated successfully!";
        $msg_style = "bi-star";
        
       // $sql_update2 = "UPDATE project_beneficiaries SET project_beneficiary_target='$targetbeneficiaries',project_beneficiary_actual='$actualbeneficiaries',date_modified=CURRENT_TIMESTAMP WHERE project_id='$project_id'";
        //$rst = mysqli_query($con, $sql_update2);
      }else{
         
      }  
        //$sql = "INSERT INTO project (project_title,	course_category,date_created) 
        //VALUES ('$projecttitle', '$courseid',CURRENT_TIMESTAMP())";
        //if (mysqli_query($con, $sql)) {
          //$main_id = LAST_INSERT_ID($sql);
          //$main_id = mysqli_insert_id($con);

          //$msg_label =  "New record created successfully!";
          //$msg_style = "bi-star";
          //} else { 
          //$msg_label =  "Error: " . $sql . "<br>" . mysqli_error($con);
          //$msg_style = "alert-warning";
          //}
  }
  if (isset($_REQUEST['submit']) && $tag='new'){

    $sql_insert = "INSERT INTO project (project_title,course_category,string_keyword,date_created) 
    VALUES ('$projecttitle', '$courseid','$strkeyword',CURRENT_TIMESTAMP())";

    if (mysqli_query($con, $sql_insert)) {
      $proj_id = mysqli_insert_id($con);
      $msg_label =  "New record created successfully!";
      $msg_style = "bi-star";

     // $sql_insert2 = "INSERT INTO project_beneficiaries (project_beneficiary_target,project_beneficiary_actual,project_id) 
      //VALUES ('$projecttitle', '$courseid','$proj_id')";
      //mysqli_query($con, $sql_insert2);
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
          <li class="breadcrumb-item">Projects</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style?>">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Project</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post" action="main.php?action=projectlistresult">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Project Title" name="projecttitle" value="<?php echo $projecttitle;?>">
                    <label for="floatingName">Project Title</label>
                  </div>
                </div>
              
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <?php  
                  $sql = "SELECT * FROM course_category";
                  $result = mysqli_query($con,$sql);
                ?>
                  
                  <select class="form-select" id="floatingSelect" aria-label="Course" name="courseid">
                    <option selected>Please Select</option>
                  <?php  while ($row = mysqli_fetch_array($result)) {
                      //$sel = $row['course_id'] == $_POST['courseid'] ? "Selected":"";
                      $sel = !isset($_POST['courseid']) ? $courseid:$_POST['courseid'];
                      $selected = $row['course_id'] == $sel ? "selected":"";
                      echo "<option value='" . $row['course_id'] . "' $selected>" . strtoupper($row['course_title']) . "</option>";
                    } ?>
                  
                    </select>
                    <label for="floatingSelect">Course Category</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingTarget" placeholder="keyword" name="strkeyword" value="<?php echo $strkeyword;?>" required>
                      <label for="floatingTarget">Keyword (use underscore ( _ ) to separate word ex. word_processing)</label>
                    </div>
                  </div>
                </div>

                <!--
                <div class="col-md-4">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingTarget" placeholder="Target Beneficiaries" name="targetbeneficiaries" value="<?php echo $targetbeneficiaries;?>">
                      <label for="floatingTarget">Target Beneficiaries</label>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingActual" placeholder="Actual Beneficiaries" name="actualbeneficiaries" value="<?php echo $actualbeneficiaries;?>">
                    <label for="floatingActual">Actual Benediciaries</label>
                  </div>
                </div>
                  -->
                <div class="text-center">
                  <input type="hidden" name="id" value="<?php echo (isset($_REQUEST['id'])) ? $_REQUEST['id']:"";?>">
                  <input type="submit" class="btn btn-primary" name="submit" value="Save">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                  <a href="main.php?action=projectlist"><button type="button" class="btn btn-warning">Back</button></a>
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
   
<script type="text/javascript">  

$("#nextpageB").click(function(){
        $("#formB").show();
        $("#formA").hide();
        $("#formC").hide();
        $("#formE").hide();
});
$("#nextpageC").click(function(){
        $("#formB").hide();
        $("#formA").hide();
        $("#formC").show();
        $("#formE").hide();
});
$("#nextpageE").click(function(){
        $("#formB").hide();
        $("#formA").hide();
        $("#formC").hide();
        $("#formE").show();
});
$("#nextpageA").click(function(){
        $("#formB").hide();
        $("#formA").show();
        $("#formC").hide();
        $("#formE").hide();
});

$("#saveB").on("click",function(){  
        //e.preventDefault();  
        $("#formB").show();
        $("#formA").hide();
        $("#formC").hide();
        $("#formE").hide();

});       

$("#saveC").on("click",function(){  
        //e.preventDefault();  
        $("#formB").hide();
        $("#formA").hide();
        $("#formC").show();
        $("#formE").hide();

});     
$("#recostat").on("click",function(){  
        //e.preventDefault();  
        $("#recommendation").show();
        $("#formA").hide();
        $("#formC").hide();
        $("#formE").hide();
        $("#formB").hide();

});   


    $("#savebtn").on("click",function(e){  
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