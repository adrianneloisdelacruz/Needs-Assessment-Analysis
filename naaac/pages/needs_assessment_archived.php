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
$style="true";
 $family_name = "";
 $first_name = "";
 $address = "";
 $city = "";
 $zip_code = "";
 $contact_no = "";
 $email = "";
//Section A
if (isset($_POST['familyname'])){
  
  //$style="aria-selected="true"";
}

$name_household_head = "";
$relationship_household_head = "";
$gender = "";
$birthdate = "";
$age_in_lastbirthday = "";
$still_studying = "";
$religion = "";
$education = "";
$marital_status = "";
$primary_sourceincome = "";
$primary_sourceincome1 = "";
$regular_income = "";
$work_skills = "";
$work_skills1il = "";
$monthly_income = "";
$philhealth = "";
$election = "";
$taxpayer = "";
$mobileno = "";

$main_id = htmlspecialchars($_REQUEST['main_id']);


  $sql = "SELECT * FROM assessment_main_info WHERE assessment_id=$main_id";
  $rst = mysqli_query($con, $sql); 

  if (mysqli_num_rows($rst)!=0){
    $row = mysqli_fetch_array($rst);
    $family_name = $row['family_name'];
    $first_name = $row['first_name'];
    $address = $row['home_address'];
    $city = $row['city'];
    $barangay = $row['barangay'];
    $contact_no = $row['contact_no'];
    $email = $row['email'];

  

  $communityassemblies = $row['communityassemblies'];
  $listprograms = $row['listprograms'];
  $whodoyoutofirst_list = $row['whodoyoutofirst'];
  $wheredoyougettreatment_list = $row['wheredoyougettreatment'];
  $firstlist = "";
  $secondlist = "";
  
}
  
?>
  </header><!-- End Header -->
    <!--<div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="main.php?action=needsassessmentArchived">
        <input type="text" name="queryString" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form> -->
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
          <li class="breadcrumb-item"><a href="main.php">Enter Responded Fullname</a></li>
          <!-- <li class="breadcrumb-item">Needs Assessment Form</li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
      <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- Pills Tabs -->
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-secA-tab" data-bs-toggle="pill" data-bs-target="#pills-secA" type="button" role="tab" aria-controls="pills-secA" aria-selected="true" >Sec. A - Indentification|</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link " id="pills-secB-tab" data-bs-toggle="pill" data-bs-target="#pills-secB" type="button" role="tab" aria-controls="pills-secB" aria-selected="false" >Sec. B - Household Information|</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-secC" type="button" role="tab" aria-controls="pills-secC" aria-selected="false">Sec. C & D  - Affiliation|</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-secE-tab" data-bs-toggle="pill" data-bs-target="#pills-secE" type="button" role="tab" aria-controls="pills-secE" aria-selected="false">Sec. E - Extension & Community Dev. Program|</button>
                </li>
              
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-secR-tab" data-bs-toggle="pill" data-bs-target="#pills-secR" type="button" role="tab" aria-controls="pills-secR" aria-selected="false">Recommendation Result|</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="pills-secA" role="tabpanel" aria-labelledby="secA-tab">
                  <!-- Multi Columns Form -->
<!--  -------------------- 1st tab section A ------------------------------------------------- -->                    
              <form method="post" class="row g-3" id="formA" name="formA">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Family Name</label>
                  <input type="text" class="form-control" id="inputName5" name="familyname" value="<?php echo $family_name;?>">
                </div>
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="inputName5" name="firstname" value="<?php echo $first_name;?>">
                </div>
                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Address (House No.& Street)</label>
                  <input type="text" class="form-control" id="inputAddres5s" name="address" placeholder="1234 Main St" value="<?php echo $address;?>">
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">City</label>
                  <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $city;?>">
                </div>
                <!--<div class="col-md-4">
                  <label for="inputState" class="form-label">Region</label>
                  <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div> -->
                <div class="col-md-2">
                  <label for="inputBarangay" class="form-label">Barangay</label>
                  <input type="text" class="form-control" id="inputBarangay" name="barangay" value="<?php echo selectBarangay($barangay);?>">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Contact Number</label>
                  <input type="text" class="form-control" id="inputContact" name="contactno" value="<?php echo $contact_no;?>">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail5" name="email" value="<?php echo $email;?>">
                </div>
                
               
            </form><!-- End Multi Columns FormA -->
            </div>

  <!--  -------------------- 2nd tab section B ------------------------------------------------- -->  
            <div class="tab-pane fade" id="pills-secB" role="tabpanel" aria-labelledby="secB-tab">
                 <!-- Multi Columns Form -->
              <form class="row g-3" id="formB" method="post">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Household Name</th>
                    <th scope="col">Relationship</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Age</th>
                    <th scope="col">Religion</th>
                    <th scope="col">Education</th>
                    <th scope="col">Marital Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php 

                        $sql = "SELECT * FROM household_members WHERE assessment_id='$main_id' ORDER BY hm_id";
                        $rst = mysqli_query($con, $sql); 
                    
                        if (mysqli_num_rows($rst)!=0){
                    
                            while($row = mysqli_fetch_array($rst)){
                                $id = $row['hm_id'];
                                $name_household_head = $row['household_name'];
                                $relationship_household_head = $row['relationshiip_household_head'];
                                $gender = $row['gender'];
                                $birthdate = $row['birthdate'];
                                $age_in_lastbirthday = $row['age_last_birthday'];
                                $still_studying = $row['still_studying'];
                                $religion = $row['religion'];
                                $education = $row['education'];
                                $marital_status = $row['marital_status'];
                                $primary_sourceincome = $row['primary_income'];
                                //$primary_sourceincome1 = $row['primarysourceincome1'];
                                $regular_income = $row['regular_income'];
                                $work_skills = $row['work_skills'];
                                //$work_skills1il = $row['workskills1'];
                                $monthly_income = $row['monthly_income'];
                                $philhealth = $row['philhealth'];
                                $election = $row['election'];
                                $taxpayer = $row['tax_payer'];
                                $mobileno = $row['mobile_no'];

                                echo "<tr>";
                                    echo "<td>" . strtoupper($name_household_head) . "</td>";
                                    echo "<td>" .  $relationship_household_head . "</td>";
                                    echo "<td>" .  strtoupper($gender) . "</td>";
                                    echo "<td>" . $age_in_lastbirthday . "</td>";
                                    echo "<td>" . $religion . "</td>";
                                    echo "<td>" . $education . "</td>";
                                    echo "<td>" . $marital_status . "</td>";

                                   echo "</tr>";
                            }
                        }else{ 
                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }
                    
                ?>    
                 
                  
                </tbody>
              </table>    
              </form><!-- End Multi Columns Form -->
            </div>
  <!-- ------------------------------ 3rd Tab Section C & D ------------------------------------------ -->
                <div class="tab-pane fade" id="pills-secC" role="tabpanel" aria-labelledby="secC-tab">
                <form class="row g-3" id="formC" method="post">
                  <div class="col-md-12">
          
                  <fieldset class="row mb-6">
                  <legend class="col-form-label col-sm-6 pt-0">Are you joining community activities/assemblies?</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="communityassemblies" id="gridRadios1" value="yes" <?php echo $communityassemblies=='yes'? "checked":""; ?>>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="communityassemblies" id="gridRadios2" value="no" <?php echo $communityassemblies=='no'? "checked":""; ?>>
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                  </div>
                </fieldset>
                </div>
                
                <div class="col-6">
                  <label for="inputAddress5" class="form-label">What kind of program is this? (Please list all)(Hit ENTER for spacing)</label>
                  <textarea class="form-control" style="height: 100px" name="listprograms"><?php echo $listprograms ?></textarea>
                </div>

                <div class="col-md-12">
          
                  <fieldset class="row mb-6">
                  <legend class="col-form-label col-sm-6 pt-0">Who do you go to first when someone in the family is sick?</legend>
                  <div class="col-sm-10">

                <?php
                  $i=0;
                  $choices = "";
                  $sql = "SELECT whodoyoutofirst FROM assessment_main_info WHERE assessment_id=$main_id";
                  $rst = mysqli_query($con, $sql); 

                  if (mysqli_num_rows($rst)!=0){

                  while($db_row = mysqli_fetch_array($rst)) {
                    $whodoyoutofirst = explode(",",$db_row['whodoyoutofirst']);
                    //$hobby=explode(",",$row['hobby']);
                  ?>
                 
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="whodoyoutofirst[]" value="none"  <?php if(in_array("none",$whodoyoutofirst)) echo 'checked="checked"'; ?>>
                      <label class="form-check-label" for="gridCheck1">
                       None
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="doctor" <?php if(in_array("doctor",$whodoyoutofirst)) echo 'checked="checked"'; ?> >
                      <label class="form-check-label" for="gridCheck2">
                        Doctor
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="self medication" <?php if(in_array("self medication",$whodoyoutofirst)) echo 'checked="checked"'; ?>>
                      <label class="form-check-label" for="gridCheck2">
                       Self Medication
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="nurse" <?php if(in_array("nurse",$whodoyoutofirst)) echo 'checked="checked"'; ?> >
                      <label class="form-check-label" for="gridCheck2">
                        Nurse
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="family member" <?php if(in_array("family member",$whodoyoutofirst)) echo 'checked="checked"'; ?> >
                      <label class="form-check-label" for="gridCheck2">
                        Family Member
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="midwife" <?php if(in_array("midwife",$whodoyoutofirst)) echo 'checked="checked"'; ?> >
                      <label class="form-check-label" for="gridCheck2">
                        Midwife
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="neighbors or friends" <?php if(in_array("neighbors or friends",$whodoyoutofirst)) echo 'checked="checked"'; ?> >
                      <label class="form-check-label" for="gridCheck2">
                        Neighbors/Friends
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="barangay health workers" <?php if(in_array("barangay health workers",$whodoyoutofirst)) echo 'checked="checked"'; ?> >
                      <label class="form-check-label" for="gridCheck2">
                        Barangay Health Workers
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst[]" value="traditional healers" <?php if(in_array("traditional healers",$whodoyoutofirst)) echo 'checked="checked"'; ?>>
                      <label class="form-check-label" for="gridCheck2">
                        Traditional Healers (Hilot,Albularyo)
                      </label>
                    </div>


                  <?php
                  $i++;
                  }
                }  
                ?>  
                  </div>
                </fieldset>
                </div>

                <div class="col-md-12">
          
                  <fieldset class="row mb-6">
                  <legend class="col-form-label col-sm-6 pt-0">Where do you get treatment when someone is sick in the family?</legend>
                  <div class="col-sm-10">
                  <?php
                  $i=0;
                  $choices = "";
                  $sql = "SELECT wheredoyougettreatment FROM assessment_main_info WHERE assessment_id=$main_id";
                  $rst = mysqli_query($con, $sql); 

                  if (mysqli_num_rows($rst)!=0){

                  while($row = mysqli_fetch_array($rst)) {
                    $wheredoyougettreatment_list = explode(",",$row['wheredoyougettreatment']);
                    
                  ?>

                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="wheredoyougettreatment[]" value="Self Medication" <?php if(in_array("Self Medication",$wheredoyougettreatment_list)) echo 'checked="checked"'; ?>>
                      <label class="form-check-label" for="gridCheck1">
                      Self Medication
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value="Hospital" <?php if(in_array("Hospital",$wheredoyougettreatment_list)) echo 'checked="checked"'; ?>>
                      <label class="form-check-label" for="gridCheck2">
                       Hospital
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value="Health Center" <?php if(in_array("Health Center",$wheredoyougettreatment_list)) echo 'checked="checked"'; ?>>
                      <label class="form-check-label" for="gridCheck2">
                      Health Center
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value="Private Clinic" <?php if(in_array("Private Clinic",$wheredoyougettreatment_list)) echo 'checked="checked"'; ?>">
                      <label class="form-check-label" for="gridCheck2">
                        Private Clinic
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value="Hilot/Albularyo" <?php if(in_array("Hilot/Albularyo",$wheredoyougettreatment_list)) echo 'checked="checked"'; ?>>
                      <label class="form-check-label" for="gridCheck2">
                        Hilot/Albularyo
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment[]" value="Others" <?php if(in_array("Others",$wheredoyougettreatment_list)) echo 'checked="checked"'; ?>>
                      <label class="form-check-label" for="gridCheck2">
                       Others
                      </label>

                    </div>
                     <div class="col-md-6">
                       <label for="inputName5" class="form-label">Please Specify...</label>
                       <input type="text" class="form-control" id="inputName5" name="wheredoyougettreatment1">
                </div>
                <?php 
                $i++;  
              }
              
                }?>
                  </div>
                </fieldset>
                </div>

                
              </form><!-- End Multi Columns Form -->
                </div>
      <!-- ----------------------------------last tab Section E --------------------------------  --- -->  
      <!-- select from database -->
              <div class="tab-pane fade" id="pills-secE" role="tabpanel" aria-labelledby="secE-tab">
          
            
                <?php 
                  $sql = "SELECT * FROM `responded_program` WHERE assessment_id='$main_id'";
                  $rst = mysqli_query($con, $sql); 
                ?>
                <div class="text-center"><hr></div>
                <form id="formAddProgram" class="row g-3" id="formF">
                  <table class="table table-bordered border-primary data-table">
                    <thead>
                      <tr>
                       <!-- <th scope="col" width="50px">ID</th>-->
                        <th scope="col" width="200px" align="center">Program</th>
                        <th scope="col" width="100px">No. of who should benefits in this Program</th>
                        <th scope="col" width="100px">No. of who wants to benefits from the program</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      
                      if (mysqli_num_rows($rst)!=0){
                        while($row = mysqli_fetch_array($rst)) {
                          $id = $row['id'];
                          //$program_id = 
                          echo "<tr>";
                                //echo "<td>" . $id . "</td>";
                                echo "<td>" . selectProgram($row['program_id']) . "</td>";
                                echo "<td>" . $row['no_benefits']."</td>";//target beneficiary
                                echo "<td>" . $row['intend_beneficiary']."</td>"; //actual beneficiary
                                echo "</tr>";
                            }//end while
                      } 
                    
                      ?>
                    <tbody>
                  </table> 
                 
                </div>
              </div><!-- End Pills Tabs -->


            <!-- ----------------------------------last tab Section E --------------------------------  --- -->  
            <div class="tab-pane fade" id="pills-secR" role="tabpanel" aria-labelledby="secR-tab">
          
            
         <!-- ----------------------------------Recommendation-Content Based Filtering Algo --------------------------------  --- -->  
         
      <h5 class="card-title"></h5>
                          <div class="col-md-12" align="center">
                            <label for="inputProgram" class="form-label" align="center"><h5>User Collected Data</h5></label>
                            <div class="col-md-12" align="center">
                  <?php 
              
        
                //include("content_based_filtering_function.php");
                $string_keyword = "";
                $mainID = htmlspecialchars($_REQUEST['main_id']); 
                //echo 
                $query =" SELECT program_id,string_keyword FROM responded_program WHERE assessment_id=$mainID";
                $rst = mysqli_query($con, $query);
                if (mysqli_num_rows($rst)!=0){
                    while ( $row = $rst->fetch_assoc() ) {
                       $program_name = selectProgram($row['program_id']);
                       $string_keyword .= $row['string_keyword']."_";

?>
                    <span align="center">  <?php echo strtoupper($program_name); ?> </br></span>

                    
<?php               } 
                }
?>
                    

<h5 class="card-title" align="center">System Recommendation Based on the Collected Data (Content-Based Filtering Algorithm)</h5>
<?php
                    $project_title = "";
                    $keyword = $string_keyword;
                       // $userPreference = ['title' => $project_title, 'category' => 'Computer'];
                      //$string_keyword1 = explode('-',$keyword);
                      //echo $string_keyword1[0];
                      //$keyw = "";
                      $str1 = $keyword;
                      $arrKeyword = explode('_',$str1);
                     // $keyw1 = $arr[0];
                      //$keyw2 = $arr[1];
                      //$keyw3 = $arr[2];
                      //$keyw3 = $arr[];
                      //foreach($arr as $i)
                        //$keyw .= $i.',';
                      //echo($i.','); MATCH (col1,col2,col3...) AGAINST (expr [search_modifier])
                     // SELECT project_id, project_title FROM project WHERE string_keyword IN('graphics','design','basic','programming') ORDER BY project_title LIMIT 3
                    //echo  $query1 = "SELECT project_id, project_title FROM project WHERE  MATCH(string_keyword) AGAINST('$keyw') ORDER BY project_title LIMIT 3";
                      
                    $query2 =" SELECT DISTINCT project_id FROM responded_program WHERE assessment_id=$mainID";
                    // $rst2 = mysqli_query($con, $query2);
                //if (mysqli_num_rows($rst2)!=0){
                  //  while ( $row = $rst2->fetch_assoc() ) {
                    //   $program_name = selectProject($row['project_id']);

                    //echo $query1;
                    //$result = $db->query($query1);  
                     
                      $rst2 = mysqli_query($con, $query2);
                       while ( $row1 = $rst2->fetch_assoc() ) {
                        $proj_id =  $row1['project_id'];
                         $project_title = selectProject($row1['project_id'])."</br>";
                                               
                         ?>
                      
                              <input class="form-check-input" type="checkbox" id="gridCheck1"  name="projects[]" value="<?php echo $proj_id?>"  checked>
                              <strong> <?php echo $project_title ?></strong></br>   
                    <?php } ?>
                
                
          </div>
                
        </div><!-- End Pills Tabs -->

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
  
        
        $(".data-table tbody").append("<tr data-programname='"+pname+"' data-noofbenefits='"+nobenefits+"' data-intendbenefits='"+intendbenefits+"'><td>"+pname+"</td><td>"+nobenefits+"</td><td>"+intendbenefits+"</td><td><button class='btn btn-danger btn-xs btn-delete'align='center'>Delete</button></td></tr>");  
        
        $("input[name='programname']").val('');  
        $("input[name='noofbenefits']").val('');  
        $("input[name='intendbenefits']").val('');
    });  
     
    $("body").on("click", ".btn-delete", function(){  
        $(this).parents("tr").remove();  
    });  

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