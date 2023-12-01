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
$main_id = !isset($_REQUEST['main_id']) ?"":htmlspecialchars($_REQUEST['main_id']);
$style="true";
$msg_label = "";
$msg_style = "";

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
//var_dump($_REQUEST);
//Section B
if (isset($_POST['namehouseholdhead']) && $_POST['namehouseholdhead']!=NULL){
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
    <div class="alert alert-primary alert-dismissible fade show" id="alertbox" role="alert" style="display:none">
      <i class="bi <?php echo $msg_style;?> me-1"></i>
      <?php echo $msg_label ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="section">
      <div class="row">
      <div class="card">
            <div class="card-body">
 

  <!--  -------------------- 2nd tab section B ------------------------------------------------- -->  
           
                 <!-- Multi Columns Form -->
              <form class="row g-3" id="formB" method="post" action="main.php?action=needsassessmentB">
              <h5 class="card-title">Section B - Household Information</h5>
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Name Of the Household Head</label>
                  <input type="text" class="form-control" id="inputName5" name="namehouseholdhead" value="<?php echo $name_household_head;?>" required>
                </div>
               <?php
               $sel_string = "Please Select";
               if(isset($_POST['submit'])){
                  //if(!empty($_POST['relationshiphouseholdhead'])) {
                    //$sel = (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == $_POST['relationshiphouseholdhead']) ? ' selected="selected"' : '';
                    //$sel_string = (isset($_POST['relationshiphouseholdhead'])) ? $_POST['relationshiphouseholdhead']:"Please Select";
                    // }
                } ?>
                  <div class="col-md-4">
                  <label for="inputState" class="form-label">Relationship to the Household Head</label>
                  <select id="inputState" class="form-select" name="relationshiphouseholdhead" required>
                    <option name="" disabled selected>Please Select</option>
                    <option value="Spouse" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Spouse') { echo "selected"; }?> >Spouse</option>
                    <option value="Father" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Father') { echo "selected"; } ?>>Father</option>
                    <option value="Mother" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Mother') { echo "selected"; } ?>>Mother</option>
                    <option value="Daughter" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Daughter') { echo "selected"; } ?>>Daughter</option>
                    <option value="Son" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Son') { echo "selected"; } ?>>Son</option>
                    <option value="GrandDaughter" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'GrandDaughter') { echo "selected"; } ?>>GrandDaughter</option>
                    <option value="GrandSon" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'GrandSon') { echo "selected"; } ?>>GrandSon</option>
                    <option value="Brother" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Brother') { echo "selected"; } ?>>Brother</option>
                    <option value="Sister" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Sister') { echo "selected"; } ?>>Sister</option>
                    <option value="Aunt" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Aunt') { echo "selected"; } ?>>Aunt</option>
                    <option value="Uncle" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Uncle') { echo "selected"; } ?>>Uncle</option>
                    <option value="Friend" <?php if (isset($_POST['relationshiphouseholdhead']) && $_POST['relationshiphouseholdhead'] == 'Friend') { echo "selected"; } ?>>Friend</option>
                  </select>
                </div>
                
                <div class="col-12">

                  <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" <?php if (isset($_POST['gender']) && $_POST['gender']=='male') { echo  "checked"; } ?> required>
                      <label class="form-check-label" for="gridRadios1">
                       Male
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female" <?php if (isset($_POST['gender']) && $_POST['gender']=='female') { echo  "checked"; } ?> required>
                      <label class="form-check-label" for="gridRadios2">
                       Female
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios3" value="lgbt"  <?php if (isset($_POST['gender']) && $_POST['gender']=='lgbt') { echo  "checked"; } ?> required>
                      <label class="form-check-label" for="gridRadios3">
                        LGBT
                      </label>
                    </div>
                  </div>
                </fieldset>

                </div>

                <div class="col-md-4">
                  <label for="inputCity" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" id="inputBirth" name="birthdate" value="<?php echo $birthdate;?>" required>
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">Age (In your last Birthday)</label>
                  <input type="text" class="form-control" id="inputAge" name="ageinlastbirthday" value="<?php echo $age_in_lastbirthday;?>" required>
                </div>
                
                <div class="col-12">

                  <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Still Studying?</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stillstudying" id="gridRadios1" value="yes" <?php if (isset($_POST['stillstudying']) && $_POST['stillstudying'] == 'yes') { echo "checked"; } ?> checked>
                      <label class="form-check-label" for="gridRadios1">
                       Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stillstudying" id="gridRadios2" value="no" <?php if (isset($_POST['stillstudying']) && $_POST['stillstudying'] == 'no'){ echo "checked";} ?>>
                      <label class="form-check-label" for="gridRadios2">
                       No
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="stillstudying" id="gridRadios2" value="na" <?php if (isset($_POST['stillstudying']) && $_POST['stillstudying'] == 'na'){ echo "checked"; }?>>
                      <label class="form-check-label" for="gridRadios2">
                       Not Applicable
                      </label>
                    </div>
                  </div>
                </fieldset>
                </div>  
                <div class="col-md-4">
                  <label for="inputReligion" class="form-label">Religion</label>
                  <select id="inputReligion" class="form-select" name="religion" required>
                    <option selected>None</option>
                    <option value="Roman Catholic" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Roman Catholic') echo ' selected="selected"'; ?>>Roman Catholic</option>
                    <option value="Protestant" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Protestant') echo ' selected="selected"'; ?>>Protestant</option>
                    <option value="Born Again" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Born Again') echo ' selected="selected"'; ?>>Born Again</option>
                    <option value="Iglesia ni Cristo" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Iglesia ni Cristo') echo ' selected="selected"'; ?>>Iglesia ni Cristo</option>
                    <option value="Islam" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Islam') echo ' selected="selected"'; ?>>Islam</option>
                    <option value="Aglipay" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Aglipay') echo ' selected="selected"'; ?>>Aglipay</option>
                    <option value="Jehova Witness" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Jehova Witness') echo ' selected="selected"'; ?>>Jehova Witness</option>
                    <option value="Tribal Religion" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Tribal Religion') echo ' selected="selected"'; ?>>Tribal Religion</option>
                    <option value="Others" <?php if (isset($_POST['religion']) && $_POST['religion'] == 'Others') echo ' selected="selected"'; ?>>Others</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="inputEducation" class="form-label">Education</label>
                  <select id="inputEduc" class="form-select" name="education" required>
                    <option selected>None</option>
                    <option value="PreSchool" <?php if (isset($_POST['education']) && $_POST['education'] == 'PreSchool') echo ' selected="selected"'; ?>>PreSchool</option>
                    <option value="Elementary Level" <?php if (isset($_POST['education']) && $_POST['education'] == 'Elementary Level') echo ' selected="selected"'; ?>>Elementary Level</option>
                    <option value="Elementary Graduate" <?php if (isset($_POST['education']) && $_POST['education'] == 'Elementary Graduate') echo ' selected="selected"'; ?>>Elementary Graduate</option>
                    <option value="High School Level" <?php if (isset($_POST['education']) && $_POST['education'] == 'High School Level') echo ' selected="selected"'; ?>>High School Level</option>
                    <option value="High School Graduate" <?php if (isset($_POST['education']) && $_POST['education'] == 'High School Graduate') echo ' selected="selected"'; ?>>High School Graduate</option>
                    <option value="Vocational" <?php if (isset($_POST['education']) && $_POST['education'] == 'Vocational') echo ' selected="selected"'; ?>>Vocational</option>
                    <option value="College Level" <?php if (isset($_POST['education']) && $_POST['education'] == 'College Level') echo ' selected="selected"'; ?>>College Level</option>
                    <option value="College Graduate" <?php if (isset($_POST['education']) && $_POST['education'] == 'College Graduate') echo ' selected="selected"'; ?>>College Graduate</option>
                    <option value="Post Graduate" <?php if (isset($_POST['education']) && $_POST['education'] == 'Post Graduate') echo ' selected="selected"'; ?>>Post Graduate</option>
                    <option value="Masteral" <?php if (isset($_POST['education']) && $_POST['education'] == 'Masteral') echo ' selected="selected"'; ?>>Masteral</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="inputMarital" class="form-label">Marital Status</label>
                  <select id="inputMarital" class="form-select" name="maritalstatus" required>
                    <option selected>Please Select</option>
                    <option value="Single" <?php if (isset($_POST['maritalstatus']) && $_POST['maritalstatus'] == 'Single') echo ' selected="selected"'; ?>>Single</option>
                    <option value="Married" <?php if (isset($_POST['maritalstatus']) &&  $_POST['maritalstatus'] == 'Married') echo ' selected="selected"'; ?>>Married</option>
                    <option value="Separated" <?php if (isset($_POST['maritalstatus']) &&  $_POST['maritalstatus'] == 'Separated') echo ' selected="selected"'; ?>>Separated</option>
                    <option value="Live-in Partner" <?php if (isset($_POST['maritalstatus']) && $_POST['maritalstatus'] == 'Live-in Partner') echo ' selected="selected"'; ?>>Live-in Partner</option>
                    <option value="Widow" <?php if (isset($_POST['maritalstatus']) && $_POST['maritalstatus'] == 'Widow') echo ' selected="selected"'; ?>>Widow</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="inputPrimaryIncome" class="form-label">Status of primary source of income</label>
                  <select id="inputPrimaryIncome" class="form-select" name="primarysourceincome" required>
                    <option selected>None</option>
                    <option value="Seasonal/Odds" <?php if (isset($_POST['primarysourceincome']) && $_POST['primarysourceincome'] == 'Seasonal/Odds') echo ' selected="selected"'; ?>>Seasonal/Odds</option>
                    <option value="Permanent" <?php if (isset($_POST['primarysourceincome']) && $_POST['primarysourceincome'] == 'Permanent') echo ' selected="selected"'; ?>>Permanent</option>
                    <option value="Contractual" <?php if (isset($_POST['primarysourceincome']) && $_POST['primarysourceincome'] == 'Contractual') echo ' selected="selected"'; ?>>Contractual</option>
                    <option value="Self-employed" <?php if (isset($_POST['primarysourceincome']) && $_POST['primarysourceincome'] == 'Self-employed') echo ' selected="selected"'; ?>>Self-employed</option>
                    <option value="Remittance" <?php if (isset($_POST['primarysourceincome']) && $_POST['primarysourceincome'] == 'Remittance') echo ' selected="selected"'; ?>>Remittance</option>
                    <option value="Pension" <?php if (isset($_POST['primarysourceincome']) && $_POST['primarysourceincome'] == 'Pension') echo ' selected="selected"'; ?>>Pension</option>
                    <option value="Others" <?php if (isset($_POST['primarysourceincome']) && $_POST['primarysourceincome'] == 'Others') echo ' selected="selected"'; ?>>Others</option>
                  </select>
                  <label for="inputState" class="form-label">Please specify</label>
                  <input type="text" class="form-control" id="inputPrimaryIncome" name="primarysourceincome1">
                </div>
                <div class="col-md-4">
                  <label for="inputRegIncome" class="form-label">Regular income</label>
                  <select id="inputRegIncome" class="form-select" name="regularincome" required>
                    <option selected>Not Applicable</option>
                    <option value="Daily" <?php if (isset($_POST['regularincome']) && $_POST['regularincome'] == 'Daily') echo ' selected="selected"'; ?>>Daily</option>
                    <option value="Weekly" <?php if (isset($_POST['regularincome']) && $_POST['regularincome'] == 'Weekly') echo ' selected="selected"'; ?>>Weekly</option>
                    <option value="Contractual" <?php if (isset($_POST['regularincome']) && $_POST['regularincome'] == 'Contractual') echo ' selected="selected"'; ?>>Contractual</option>
                    <option value="Bi-Monthly" <?php if (isset($_POST['regularincome']) && $_POST['regularincome'] == 'Bi-Monthly') echo ' selected="selected"'; ?>>Bi-Monthly</option>
                    <option value="Monthly" <?php if (isset($_POST['regularincome']) && $_POST['regularincome'] == 'Monthly') echo ' selected="selected"'; ?>>Monthly</option>
                    <option value="Irregular" <?php if (isset($_POST['regularincome']) && $_POST['regularincome'] == 'Irregular') echo ' selected="selected"'; ?>>Irregular</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="inputskills" class="form-label">Work Skills</label>
                  <select id="inputskills" class="form-select" name="workskills" required>
                    <option selected>Please Select</option>
                    <option value="None" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'None') echo ' selected="selected"'; ?>>None</option>
                    <option value="Caregiver/Child OR Adult care" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Caregiver/Child OR Adult care') echo ' selected="selected"'; ?>>Caregiver/Child OR Adult care</option>
                    <option value="Household Skills(ex. Laundry, Ironing)" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Household Skills(ex. Laundry, Ironing)') echo ' selected="selected"'; ?>>Household Skills(ex. Laundry, Ironing)</option>
                    <option value="Food Preparation" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Food Preparation') echo ' selected="selected"'; ?>>Food Preparation</option>
                    <option value="Tailoring" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Tailoring') echo ' selected="selected"'; ?>>Tailoring</option>
                    <option value="Secretarial/Bookeeping" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Secretarial/Bookeeping') echo ' selected="selected"'; ?>>Secretarial/Bookeeping</option>
                    <option value="Auto Repair/Car tune-up" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Auto Repair/Car tune-up') echo ' selected="selected"'; ?>>Auto Repair/Car tune-up</option>
                    <option value="Driving" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Driving') echo ' selected="selected"'; ?>>Driving</option>
                    <option value="General Repair(Appliances,Equipment)" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'General Repair(Appliances,Equipment)') echo ' selected="selected"'; ?>>General Repair(Appliances,Equipment)</option>
                    <option value="Plumbing" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Plumbing') echo ' selected="selected"'; ?>>Plumbing</option>
                    <option value="Carpentry" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Carpentry') echo ' selected="selected"'; ?>>Carpentry</option>
                    <option value="Welding" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Welding') echo ' selected="selected"'; ?>>Welding</option>
                    <option value="Construction Skills" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Construction Skills') echo ' selected="selected"'; ?>>Construction Skills</option>
                    <option value="Laborer" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Laborer') echo ' selected="selected"'; ?>>Laborer</option>
                    <option value="Beautician/Cosmetology" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Beautician/Cosmetology') echo ' selected="selected"'; ?>>Beautician/Cosmetology</option>
                    <option value="Computer Skills" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Computer Skills') echo ' selected="selected"'; ?>>Computer Skills</option>
                    <option value="Other" <?php if (isset($_POST['workskills']) && $_POST['workskills'] == 'Other') echo ' selected="selected"'; ?>>Other</option>
                  </select>
                  <label for="inputskills" class="form-label">Please specify</label>
                  <input type="text" class="form-control" id="inputskills1" name="workskills1">
                </div>

                <div class="col-md-4">
                  <label for="inputMonthlyincome" class="form-label">Ave. Monthly Income</label>
                  <input type="text" class="form-control" id="inputMonthlyincome" name="monthlyincome" value="<?php if (isset($_POST['monthlyincome']) && $_POST['monthlyincome']!='') { echo $_POST['monthlyincome']; }?>" required>
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">Philhealth Member?</label>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="philhealth" id="gridRadios1" value="yes" <?php if (isset($_POST['philhealth']) && $_POST['philhealth'] == 'yes'){ echo "checked"; }?> checked>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="philhealth" id="gridRadios2" value="no" <?php if (isset($_POST['philhealth']) && $_POST['philhealth'] == 'no') { echo "checked"; } ?>>
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="philhealth" id="gridRadios2" value="na" <?php if (isset($_POST['philhealth']) && $_POST['philhealth'] == 'na') { echo "checked";} ?>>
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
                      <input class="form-check-input" type="radio" name="election" id="gridRadios1" value="yes" <?php if (isset($_POST['election']) && $_POST['election'] == 'yes'){ echo "checked"; } ?> checked>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="election" id="gridRadios2" value="no" <?php if (isset($_POST['election']) && $_POST['election'] == 'no'){ echo "checked";} ?>>
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="election" id="gridRadios2" value="na" <?php if (isset($_POST['election']) && $_POST['election'] == 'na'){ echo "checked"; }?>>
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
                      <input class="form-check-input" type="radio" name="taxpayer" id="gridRadios1" value="yes" <?php if (isset($_POST['taxpayer']) && $_POST['taxpayer'] == 'yes'){ echo "checked";} ?> checked>
                      <label class="form-check-label" for="gridRadios1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="taxpayer" id="gridRadios2" value="no" <?php if (isset($_POST['taxpayer']) && $_POST['taxpayer'] == 'no') { echo "checked"; }?>>
                      <label class="form-check-label" for="gridRadios2">
                        No
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="taxpayer" id="gridRadios2" value="na" <?php if (isset($_POST['taxpayer']) && $_POST['taxpayer'] == 'na'){ echo "checked";} ?>>
                      <label class="form-check-label" for="gridRadios2">
                        Not Applicable
                      </label>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <label for="inputMobile" class="form-label">Mobile NO.</label>
                  <input type="text" class="form-control" id="inputMobile" name="mobileno" value="<?php if (isset($_POST['mobileno']) && $_POST['mobileno']!=''){ echo $_POST['mobileno'];}?>" required>
                </div>
                <div class="text-center">
                

                  <button type="submit" class="btn btn-primary" id="saveB">Save Section B</button>
                  <input type="hidden" name="main_id" value="<?=$main_id;?>">
                  <input type="hidden" name="action" value="needsassessmentB">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                  <a href="main.php?action=needsassessmentC&main_id=<?=$main_id?>"><input type="button" class="btn btn-warning" id="nextpageC" value="Next Page -> Section C"></a>
                </div>

              </form><!-- End Multi Columns Form -->
  
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
   

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script>
		
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
	</script>

<script type="text/javascript">  
 
jQuery("#inputBirth").on('change',function(){
       var dob1 = jQuery(this).val();
       var inputBirth = $.datepicker.formatDate('yy-mm-dd', new Date(dob1));
       var str = inputBirth.split('-');    
       var firstdate=new Date(str[0],str[1],str[2]);
       var today = new Date();        
       var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
       var age = parseInt(dayDiff);
      // alert(age);
       jQuery("#inputAge").val(age);
   });

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

/*$("#nextpageE").click(function(){
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
  
        
        $(".data-table tbody").append("<tr data-programname='"+pname+"' data-noofbenefits='"+nobenefits+"' data-intendbenefits='"+intendbenefits+"'><td>"+pname+"</td><td>"+nobenefits+"</td><td>"+intendbenefits+"</td><td><button class='btn btn-danger btn-xs btn-delete'align='center'>Delete</button></td></tr>");  
        
        $("input[name='programname']").val('');  
        $("input[name='noofbenefits']").val('');  
        $("input[name='intendbenefits']").val('');
    });  
     
    $("body").on("click", ".btn-delete", function(){  
        $(this).parents("tr").remove();  
    });   

    function closeMe() {
      $('#alertbox').hide();
    }
*/
    
</script>  

</body>

</html>