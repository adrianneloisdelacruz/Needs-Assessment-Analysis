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


$style="display:none";
$msg_label = "";
$msg_style = "";
$main_id = !isset($_REQUEST['main_id']) ?"":htmlspecialchars($_REQUEST['main_id']);
$bid = !isset($_REQUEST['bid']) ?"":htmlspecialchars($_REQUEST['bid']);

if (isset($_POST['communityassemblies'])){

  //$mainID = htmlspecialchars($_REQUEST['main_id']); 
  $communityassemblies = $_POST['communityassemblies'];
  $listprograms = $_POST['listprograms'];
  $secondlist = "";
  $firstlist = "";

  if (isset($_POST['whodoyoutofirst']) && !empty($_POST['whodoyoutofirst'])){
    $whodoyoutofirst_list = $_POST['whodoyoutofirst'];  
    
  foreach($whodoyoutofirst_list as $firstlist1)  
    {  
        $firstlist .= $firstlist1.",";  
    }  
  }

  if (isset($_POST['wheredoyougettreatment']) && !empty($_POST['wheredoyougettreatment'])){
    $wheredoyougettreatment_list = $_POST['wheredoyougettreatment'];
    
  foreach($wheredoyougettreatment_list as $secondlist1)  
   {  
      $secondlist .= $secondlist1.",";  
    }
  }    

 
    $sql_updateSecC = "UPDATE assessment_main_info SET 
          communityassemblies = '$communityassemblies',
          listprograms = '$listprograms',
          whodoyoutofirst = '$firstlist',
          wheredoyougettreatment ='$secondlist',
          date_modified = CURRENT_TIMESTAMP() WHERE assessment_id=$main_id";
        
        if (mysqli_query($con, $sql_updateSecC)) {
          $msg_label =  "Record updated successfully!";
          $msg_style = "bi-star";
          $style = "";
        } else { 
          //$msg_label =  "Error: " . $sql_updateSecC . "<br>" . mysqli_error($con);
          $msg_style = "alert-warning";
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
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="<?php echo $style;?>">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
      <div class="row">
      <div class="card">
            <div class="card-body">

  <!-- ------------------------------ 3rd Tab Section C & D ------------------------------------------ -->
                
                <form class="row g-3" id="formC" method="post" action="main.php?action=needsassessmentC">
                <h5 class="card-title">Section C & D  - Affiliation</h5>
                  <div class="col-md-12">
          
                  <fieldset class="row mb-6">
                  <legend class="col-form-label col-sm-6 pt-0">Are you joining community activities/assemblies?</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="communityassemblies" id="gridRadios1" value="yes" <?php (isset($_POST['communityassemblies']) && $_POST['communityassemblies'] =='yes') ? "checked":"";?> checked>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="communityassemblies" id="gridRadios2" value="no" <?php (isset($_POST['communityassemblies']) && $_POST['communityassemblies']=='no') ? "checked":""?>>
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                  </div>
                </fieldset>
                </div>
                
                <div class="col-6">
                  <label for="inputAddress5" class="form-label">What kind of program is this? (Please list all and use comma as separator)</label>
                  <textarea class="form-control" style="height: 100px" name="listprograms"><?php if (isset($_POST['listprograms'])){ echo $_POST['listprograms']; }?></textarea>
                </div>

                <div class="col-md-12">
          
                  <fieldset class="row mb-6">
                  <legend class="col-form-label col-sm-6 pt-0">Who do you go to first when someone in the family is sick?</legend>
                  <div class="col-sm-10">
                  <?php
                  
                  $str = "";
                  //if(isset($_POST['submit'])){
                    
                    if(!empty($_POST['whodoyoutofirst'])){
                      $choices = $_POST['whodoyoutofirst'];
                      foreach($choices as $checked){
                        $str = $checked;
                        
                        ?>
                        
                      <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1"  name="whodoyoutofirst[]" value="<?php echo $str?>" checked>
                      <label class="form-check-label" for="gridCheck1">
                       <?php echo ucwords($str);?>
                      </label>
                    </div>


                      <?php    
                        }
                  ?>      
                 <!-- <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="whodoyoutofirst[]" value="none" <?php ($str=='none')? 'checked':'';?>>
                      <label class="form-check-label" for="gridCheck1">
                       None
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="doctor" <?php if ($str=='doctor'){ "checked";}?>>
                      <label class="form-check-label" for="gridCheck2">
                        Doctor
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="self medication" <?php if ($str=='self medication'){ "checked";}?>>
                      <label class="form-check-label" for="gridCheck2">
                       Self Medication
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="nurse" <?php echo $checked;?>>
                      <label class="form-check-label" for="gridCheck2">
                        Nurse
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="family member" <?php echo $checked;?>>
                      <label class="form-check-label" for="gridCheck2">
                        Family Member
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="midwife" <?php echo $checked;?>>
                      <label class="form-check-label" for="gridCheck2">
                        Midwife
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="neighbors or friends" <?php echo $checked;?>>
                      <label class="form-check-label" for="gridCheck2">
                        Neighbors/Friends
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="barangay health workers" <?php echo $checked;?>>
                      <label class="form-check-label" for="gridCheck2">
                        Barangay Health Workers
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="traditional healers" <?php echo $checked;?>>
                      <label class="form-check-label" for="gridCheck2">
                        Traditional Healers (Hilot,Albularyo)
                      </label>
                    </div> -->
                  <?php
                    
                  }else{ ?>

                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="whodoyoutofirst[]" value="none">
                      <label class="form-check-label" for="gridCheck1">
                       None
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="doctor">
                      <label class="form-check-label" for="gridCheck2">
                        Doctor
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="self medication">
                      <label class="form-check-label" for="gridCheck2">
                       Self Medication
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="nurse"?
                      <label class="form-check-label" for="gridCheck2">
                        Nurse
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="family member">
                      <label class="form-check-label" for="gridCheck2">
                        Family Member
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="midwife">
                      <label class="form-check-label" for="gridCheck2">
                        Midwife
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="neighbors or friends">
                      <label class="form-check-label" for="gridCheck2">
                        Neighbors/Friends
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="barangay health workers">
                      <label class="form-check-label" for="gridCheck2">
                        Barangay Health Workers
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="traditional healers">
                      <label class="form-check-label" for="gridCheck2">
                        Traditional Healers (Hilot,Albularyo)
                      </label>
                    </div>

               <?php   }  
                  ?>    
                  </div>
                </fieldset>
                </div>

                <div class="col-md-12">
          
                  <fieldset class="row mb-6">
                  <legend class="col-form-label col-sm-6 pt-0">Where do you get treatment when someone is sick in the family?</legend>
                  <div class="col-sm-10">
                    <?php  
                      if(!empty($_POST['wheredoyougettreatment'])){
                      $selected = $_POST['wheredoyougettreatment'];
                      foreach($selected as $checked){
                        $str = $checked;
                        ?>
                        <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="wheredoyougettreatment[]" value="<?php echo $str?>" checked>
                      <label class="form-check-label" for="gridCheck1">
                      <?php echo ucwords($str);?>
                      </label>
                    </div>


                      <?php }  
                      
                      }else{  
                      ?>

                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="wheredoyougettreatment[]" value="Self Medication">
                      <label class="form-check-label" for="gridCheck1">
                      Self Medication
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value="Hospital">
                      <label class="form-check-label" for="gridCheck2">
                       Hospital
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value=" Health Center">
                      <label class="form-check-label" for="gridCheck2">
                      Health Center
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value=" Private Clinic">
                      <label class="form-check-label" for="gridCheck2">
                        Private Clinic
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value="Hilot/Albularyo">
                      <label class="form-check-label" for="gridCheck2">
                        Hilot/Albularyo
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value="others">
                      <label class="form-check-label" for="gridCheck2">
                       Others
                      </label>

                    </div>
                     <div class="col-md-6">
                       <label for="inputName5" class="form-label">Please Specify...</label>
                       <input type="text" class="form-control" id="inputName5" name="wheredoyougettreatment1">
                      </div>
                  <?php } ?>    
                  </div>
                </fieldset>
                </div>

                <div class="text-center">
                 
                  <input type="hidden" name="main_id" value="<?=$main_id?>">
                  <input type="hidden" name="action" value="needsassessmentC">
                  <input type="hidden" name="bid" value="<?=$bid?>">
                  <button type="submit" class="btn btn-primary" name="saveC">Save Section C&D</button>
                 <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                  <a href="main.php?action=needsassessmentE&main_id=<?=$main_id?>&bid=<?php echo $bid?>"><button type="button" class="btn btn-warning" id="nextpageE">Next Page ->Section E</button></a>
                </div>
              </form><!-- End Multi Columns Form -->
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