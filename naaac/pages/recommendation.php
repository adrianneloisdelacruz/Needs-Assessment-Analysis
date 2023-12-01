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

$main_id = !isset($_REQUEST['main_id']) ?"":$_REQUEST['main_id'];
$style="display:none";
$msg_label = "";
$msg_style = "";
$choices = "";
$str = "";
$chk = "";
$sql = "SELECT * FROM responded_program WHERE assessment_id='$main_id'";
$rst = mysqli_query($con, $sql); 
$projects_list = "";
$projlist = "";


if (isset($_POST['submit'])){

  if (mysqli_num_rows($rst)!=0){
    if (isset($_POST['projects']) && !empty($_POST['projects'])){
      $projects_list = $_POST['projects'];  
      
    foreach($projects_list as $list)  
      {  
        $projlist .= $list.",";  
      }  
    }

      $sql_updateReco = "UPDATE responded_program SET project_id='$projlist' WHERE assessment_id='$main_id'";
      $rst = mysqli_query($con, $sql_updateReco);
      if (mysqli_query($con, $sql_updateReco)) {
        
        $update = "UPDATE assessment_main_info SET project_id='$projlist' WHERE assessment_id='$main_id'";
        $rst1 = mysqli_query($con, $update);

        $msg_label =  "Recommendation Save Successfully!";
        $msg_style = "bi-star";
        $style = "";
      } else { 
        $msg_style = "alert-warning";
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
          <li class="breadcrumb-item">Needs Assessment Form | Recommendation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style;?>">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
      <div class="row">
      <div class="card">
            <div class="card-body">
              

      <!-- ----------------------------------Recommendation-Content Based Filtering Algo --------------------------------  --- -->  
      <form method="post" action="main.php?action=recommendation">
      <h5 class="card-title"></h5>
                          <div class="col-md-12" align="center">
                            <label for="inputProgram" class="form-label" align="center"><h5>User Collected Data</h5></label>
                            <div class="col-md-12" align="center">
                  <?php 
              
        
                //include("content_based_filtering_function.php");
                $string_keyword = "";
                $mainID = isset($_REQUEST['main_id']) ? htmlspecialchars($_REQUEST['main_id']):"";
                //$mainID = 1;
                if  (empty($mainID)){
                  echo "Details incomplete missing ID";
                  exit;
                }
            
               $query =" SELECT program_id,string_keyword FROM responded_program WHERE assessment_id=$mainID";
                $rst = mysqli_query($con, $query);
                if (mysqli_num_rows($rst)!=0){
                    while ( $row = $rst->fetch_assoc() ) {
                       $program_name = selectProgram($row['program_id']);
                       $string_keyword .= $row['string_keyword']."_";

?>
                    <span align="center">  <?php echo strtoupper($program_name); ?> </br></span>

                    
<?php               } ?>
                    

<h5 class="card-title" align="center">System Recommendation Based on the Collected Data (Content-Based Filtering Algorithm)</h5>
<?php
                      $project_title = "";
                      $keyword = $string_keyword;
                      $str1 = $keyword;
                      $arrKeyword = explode('_',$str1);
                      
                      $query1 ="SELECT * FROM project WHERE string_keyword like '%" . $arrKeyword[0] . "%' ";
                        for($i = 1; $i < count($arrKeyword); $i++) {
                          if(!empty($arrKeyword[$i])) {
                            $query1 .= " OR string_keyword like '%" . $arrKeyword[$i] . "%'";

                          }
                        }
                      $query1 .= " ORDER BY RAND() limit 1";  
                      $rst1 = mysqli_query($con, $query1);
                       while ( $row1 = $rst1->fetch_assoc() ) {
                        $proj_id =  $row1['project_id'];
                         $project_title =$row1['project_title']."</br>";
                                               
                         
                      if ($project_title != $arrKeyword) { 

                         if(!empty($_POST['projects'])){
                          $choices = $_POST['projects'];
                          foreach($choices as $checked){
                            $str = $checked;
                            $chk =  ($proj_id == $str) ? "checked":"";
                            }
                          } 
                        ?>
  
                              <input class="form-check-input" type="checkbox" id="gridCheck1"  name="projects[]" value="<?php echo $proj_id?>"  checked>
                              <strong> <?php echo $project_title ?></strong></br>   
                    <?php } 
                       ?>
                      
                  
                       <?php

                       }
                    }
                   
                 
                  ?>
                  
                <div class="text-center">
                 
                  <input type="hidden" name="main_id" value="<?php echo $main_id?>">
                  
                  <button type="submit" class="btn btn-primary" name="submit">Save Recommendation</button>
                  
                  
                </div>
          </div>
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
    $("#savebtn").on("click",function(e){  
        e.preventDefault();  
        var pname = $("input[name='programname']").val();  
        var nobenefits = $("input[name='noofbenefits']").val();  
        var intendbenefits = $("input[name='intendbenefits']").val();  
  
        
       // $(".data-table tbody").append("<tr data-programname='"+pname+"' data-noofbenefits='"+nobenefits+"' data-intendbenefits='"+intendbenefits+"'><td>"+pname+"</td><td>"+nobenefits+"</td><td>"+intendbenefits+"</td><td><button class='btn btn-danger btn-xs btn-delete'align='center'>Delete</button></td></tr>");  
        
        $("input[name='programname']").val('');  
        $("input[name='noofbenefits']").val('');  
        $("input[name='intendbenefits']").val('');
    });  
     
    $("#recostat").on("click",function(){  
        //e.preventDefault();  
        $("#recommendation").show();
        $("#formA").hide();
        $("#formC").hide();
        $("#formE").hide();
        $("#formB").hide();

});   

    $("body").on("click", ".btn-delete", function(){  
        //$(this).parents("tr").remove();  
    });   

    function closeMe() {
      $('#alertbox').hide();
    }
    
</script>  

</body>

</html>