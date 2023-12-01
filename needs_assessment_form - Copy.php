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
  $family_name = $_POST['familyname'];
  $first_name = $_POST['firstname'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $zip_code = $_POST['zipcode'];
  $contact_no = $_POST['contactno'];
  $email = $_POST['email'];
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

//Section B
if (isset($_POST['namehouseholdhead'])){
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
  $primary_sourceincome1 = $_POST['primarysourceincome1'];
  $regular_income = $_POST['regularincome'];
  $work_skills = $_POST['workskills'];
  $work_skills1il = $_POST['workskills1'];
  $monthly_income = $_POST['monthlyincome'];
  $philhealth = $_POST['philhealth'];
  $election = $_POST['election'];
  $taxpayer = $_POST['taxpayer'];
  $mobileno = $_POST['mobileno'];
  
}
if (!isset($_REQUEST['tab']) ||  $_REQUEST['tab'] == ''){
  $tab_active1 = "active";
  $tab_active2 = "";
  $tab_active3 = "";
  $tab_active4 = "";
}
if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == '2'){
  $tab_active1 = "";
  $tab_active2 = "active";
  $tab_active3 = "";
  $tab_active4 = "";
}
if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == '3'){
  $tab_active1 = "";
  $tab_active2 = "";
  $tab_active3 = "active";
  $tab_active4 = "";
}
if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == '4'){
  $tab_active1 = "";
  $tab_active2 = "";
  $tab_active3 = "";
  $tab_active4 = "active";
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
                  <label for="inputZip" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="inputZip" name="zipcode" value="<?php echo $zip_code;?>">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Contact Number</label>
                  <input type="text" class="form-control" id="inputContact" name="contactno" value="<?php echo $contact_no;?>">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail5" name="email" value="<?php echo $email;?>">
                </div>
                
                <div class="text-center">
                
                  <input type="hidden" class="btn btn-primary" name="action" value="needsassessment">
                  <input type="hidden" name="tab" value="">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End Multi Columns FormA -->
            </div>

  <!--  -------------------- 2nd tab section B ------------------------------------------------- -->  
            <div class="tab-pane fade" id="pills-secB" role="tabpanel" aria-labelledby="secB-tab">
                 <!-- Multi Columns Form -->
              <form class="row g-3" id="formB" method="post">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Name Of the Household Head</label>
                  <input type="text" class="form-control" id="inputName5" name="namehouseholdhead" value="<?php echo $name_household_head;?>">
                </div>
                
                  <div class="col-md-4">
                  <label for="inputState" class="form-label">Relationship to the Household Head</label>
                  <select id="inputState" class="form-select" name="relationshiphouseholdhead">
                    <option selected>Spouse</option>
                    <option>Father</option>
                    <option>Mother</option>
                    <option>Daughter</option>
                    <option>Son</option>
                    <option>GrandDaughter</option>
                    <option>GrandSon</option>
                    <option>Brother</option>
                    <option>Sister</option>
                    <option>Aunt</option>
                    <option>Uncle</option>
                    <option>Friend</option>
                  </select>
                </div>
                
                <div class="col-12">

                  <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" checked>
                      <label class="form-check-label" for="gridRadios1">
                       Male
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">
                      <label class="form-check-label" for="gridRadios2">
                       Female
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios3" value="lgbt" >
                      <label class="form-check-label" for="gridRadios3">
                        LGBT
                      </label>
                    </div>
                  </div>
                </fieldset>

                </div>

                <div class="col-md-4">
                  <label for="inputCity" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" id="inputBirth" name="birthdate">
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">Age (In your last Birthday)</label>
                  <input type="text" class="form-control" id="inputCity" name="ageinlastbirthday">
                </div>
                
                

                <div class="col-12">

                  <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Still Studying?</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stillstudying" id="gridRadios1" value="yes" checked>
                      <label class="form-check-label" for="gridRadios1">
                       Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stillstudying" id="gridRadios2" value="no">
                      <label class="form-check-label" for="gridRadios2">
                       No
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stillstudying" id="gridRadios2" value="na">
                      <label class="form-check-label" for="gridRadios2">
                       Not Applicable
                      </label>
                    </div>
                  </div>
                </fieldset>
                </div>  
                <div class="col-md-4">
                  <label for="inputReligion" class="form-label">Religion</label>
                  <select id="inputReligion" class="form-select" name="religion">
                    <option selected>None</option>
                    <option>Roman Catholic</option>
                    <option>Protestant</option>
                    <option>Born Again</option>
                    <option>Iglesia ni Cristo</option>
                    <option>Islam</option>
                    <option>Aglipay</option>
                    <option>Jehova Witness</option>
                    <option>Tribal Religion</option>
                    <option>Others</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="inputEducation" class="form-label">Education</label>
                  <select id="inputEduc" class="form-select" name="education">
                    <option selected>None</option>
                    <option>PreSchool</option>
                    <option>Elementary Level</option>
                    <option>Elementary Graduate</option>
                    <option>High School Level</option>
                    <option>High School Graduate</option>
                    <option>Vocational</option>
                    <option>College Level</option>
                    <option>College Graduate</option>
                    <option>Post Graduate</option>
                    <option>Masteral</option>
                    <option>PHD</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="inputMarital" class="form-label">Marital Status</label>
                  <select id="inputMarital" class="form-select" name="maritalstatus">
                    <option selected>Single</option>
                    <option>Married</option>
                    <option>Separated</option>
                    <option>Live-in Partner</option>
                    <option>Widow</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="inputPrimaryIncome" class="form-label">Status of primary source of income</label>
                  <select id="inputPrimaryIncome" class="form-select" name="primarysourceincome">
                    <option selected>None</option>
                    <option>Seasonal/Odds</option>
                    <option>Permanent</option>
                    <option>Contractual</option>
                    <option>Self-employed</option>
                    <option>Remittance</option>
                    <option>Pension</option>
                    <option>Others</option>
                  </select>
                  <label for="inputState" class="form-label">Please specify</label>
                  <input type="text" class="form-control" id="inputPrimaryIncome" name="primarysourceincome1">
                </div>
                <div class="col-md-4">
                  <label for="inputRegIncome" class="form-label">Regular income</label>
                  <select id="inputRegIncome" class="form-select" name="regularincome">
                    <option selected>Not Applicable</option>
                    <option>Daily</option>
                    <option>Weekly</option>
                    <option>Contractual</option>
                    <option>Bi-Monthly</option>
                    <option>Monthly</option>
                    <option>Irregular</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="inputskills" class="form-label">Work Skills</label>
                  <select id="inputskills" class="form-select" name="workskills">
                    <option selected>Pls. Select</option>
                    <option>None</option>
                    <option>Caregiver/Child OR Adult care</option>
                    <option>Household Skills(ex. Laundry, Ironing)</option>
                    <option>Food Preparation</option>
                    <option>Tailoring</option>
                    <option>Secretarial/Bookeeping</option>
                    <option>Auto Repair/Car tune-up</option>
                    <option>Driving</option>
                    <option>General Repair(Appliances,Equipment)</option>
                    <option>Plumbing</option>
                    <option>Carpentry</option>
                    <option>Welding</option>
                    <option>Construction Skills</option>
                    <option>Laborer</option>
                    <option>Beautician/Cosmetology</option>
                    <option>Computer Skills</option>
                    <option>Other</option>
                  </select>
                  <label for="inputskills" class="form-label">Please specify</label>
                  <input type="text" class="form-control" id="inputskills1" name="workskills1">
                </div>

                <div class="col-md-4">
                  <label for="inputMonthlyincome" class="form-label">Ave. Monthly Income</label>
                  <input type="text" class="form-control" id="inputMonthlyincome" name="monthlyincome">
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">Philhealth Member?</label>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="philhealth" id="gridRadios1" value="yes" checked>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="philhealth" id="gridRadios2" value="no">
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="philhealth" id="gridRadios2" value="na">
                      <label class="form-check-label" for="gridRadios2">
                        Not Applicable
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">Did you vote in the last election?</label>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="election" id="gridRadios1" value="yes" checked>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="election" id="gridRadios2" value="no">
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="election" id="gridRadios2" value="na">
                      <label class="form-check-label" for="gridRadios2">
                        Not Applicable
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="inputTax" class="form-label">Are you a tax payer?</label>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="taxpayer" id="gridRadios1" value="yes" checked>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="taxpayer" id="gridRadios2" value="no">
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="taxpayer" id="gridRadios2" value="na">
                      <label class="form-check-label" for="gridRadios2">
                        Not Applicable
                      </label>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <label for="inputMobile" class="form-label">Mobile NO.</label>
                  <input type="text" class="form-control" id="inputMobile" name="mobileno">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <input type="hidden" name="tab" value="2">
                  <input type="hidden" name="action" value="needsassessment">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>

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
                      <input class="form-check-input" type="radio" name="communityassemblies" id="gridRadios1" value="yes" checked>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="communityassemblies" id="gridRadios2" value="no">
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                  </div>
                </fieldset>
                </div>
                
                <div class="col-6">
                  <label for="inputAddress5" class="form-label">What kind of program is this? (Please list all)(Hit ENTER for spacing)</label>
                  <textarea class="form-control" style="height: 100px" name="listprograms"></textarea>
                </div>

                <div class="col-md-12">
          
                  <fieldset class="row mb-6">
                  <legend class="col-form-label col-sm-6 pt-0">Who do you go to first when someone in the family is sick?</legend>
                  <div class="col-sm-10">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="whodoyoutofirst" value="none">
                      <label class="form-check-label" for="gridCheck1">
                       None
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst" value="doctor">
                      <label class="form-check-label" for="gridCheck2">
                        Doctor
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst" value="self medication">
                      <label class="form-check-label" for="gridCheck2">
                       Self Medication
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst" value="nurse"?
                      <label class="form-check-label" for="gridCheck2">
                        Nurse
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst" value="family member">
                      <label class="form-check-label" for="gridCheck2">
                        Family Member
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst" value="midwife">
                      <label class="form-check-label" for="gridCheck2">
                        Midwife
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst" value="neighbors or friends">
                      <label class="form-check-label" for="gridCheck2">
                        Neighbors/Friends
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst" value="barangay health workers">
                      <label class="form-check-label" for="gridCheck2">
                        Barangay Health Workers
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="whodoyoutofirst" value="traditional healers">
                      <label class="form-check-label" for="gridCheck2">
                        Traditional Healers (Hilot,Albularyo)
                      </label>
                    </div>
                  </div>
                </fieldset>
                </div>

                <div class="col-md-12">
          
                  <fieldset class="row mb-6">
                  <legend class="col-form-label col-sm-6 pt-0">Where do you get treatment when someone is sick in the family?</legend>
                  <div class="col-sm-10">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="wheredoyougettreatment">
                      <label class="form-check-label" for="gridCheck1">
                      Self Medication
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment">
                      <label class="form-check-label" for="gridCheck2">
                       Hospiital
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment">
                      <label class="form-check-label" for="gridCheck2">
                      Health Center
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment">
                      <label class="form-check-label" for="gridCheck2">
                        Private Clinic
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment">
                      <label class="form-check-label" for="gridCheck2">
                        Hilot/Albularyo
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" name="wheredoyougettreatment">
                      <label class="form-check-label" for="gridCheck2">
                       Others
                      </label>

                    </div>
                     <div class="col-md-6">
                       <label for="inputName5" class="form-label">Please Specify...</label>
                       <input type="text" class="form-control" id="inputName5" name="wheredoyougettreatment1">
                </div>
                  </div>
                </fieldset>
                </div>

                <div class="text-center">
                  <input type="hidden" name="action" value="needsassessment">
                  <input type="hidden" name="tab" value="3">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->
                </div>
      <!-- ----------------------------------last tab Section E --------------------------------  --- -->  
                <div class="tab-pane fade" id="pills-secE" role="tabpanel" aria-labelledby="secE-tab">
          
              <form id="formAddProgram" class="row g-3" id="formE" method="post">
                <div class="col-md-6">
                  <label for="inputProgram" class="form-label">Program</label>
                  <input type="text" name="programname" class="form-control" id="programname">
                </div>
                <span> </span>
                <div class="col-md-3">
                  <label for="inputBenefits" class="form-label">How many should benefits in this Program?</label>
                  <input type="text" name="noofbenefits" class="form-control" id="noofbenefits">
                </div>
                <div class="col-md-3">
                  <label for="inputIntenBenefits" class="form-label">How many wants or intend to benefits from the program?</label>
                  <input type="text" name="intendbenefits" class="form-control" id="intendbenefits">
                </div>
                
                <div class="text-left">
                  <button type="button" class="btn btn-primary" id="savebtn">Add</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->
                  <div class="text-center"><hr></div>
                <form id="formAddProgram" class="row g-3" id="formF">
                  <table class="table table-bordered border-primary data-table">
                    <thead>
                      <tr>
                        <th scope="col">Program</th>
                        <th scope="col" width="200px">No. of who should benefits in this Program</th>
                        <th scope="col" width="200px">No. of who wants to benefits from the program</th>
                        <th scope="col" width="100px" align="center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    <tbody>
                  </table> 
                  <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Table</button>
                </div>     
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