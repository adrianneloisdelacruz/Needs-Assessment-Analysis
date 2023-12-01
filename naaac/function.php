<?php

function selectCourse($id)
{
  include("config/connect.php");
  $sql = "SELECT course_title FROM course_category WHERE course_id='$id'";

  if ($rst = mysqli_query($con, $sql)) {
    $row = mysqli_fetch_array($rst);
    $course_title = $row['course_title'];

    //$msg_label =  "Record updated successfully!";
    //$msg_style = "bi-star";
  } else {
    //$msg_label =  "Error: " . $sql_update . "<br>" . mysqli_error($con);
    //$msg_style = "alert-warning";
  }

  return $course_title;
}

function selectProgram($id)
{
  include("config/connect.php");
  $sql = "SELECT program_title FROM program WHERE program_id='$id'";
  $rst = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($rst);
  $program_title = $row['program_title'];
  return $program_title;
}

function selectProject($id)
{
  include("config/connect.php");
  $project_title = "";
  $query1 = "SELECT project_id,project_title FROM project WHERE project_id='$id'";
  $rst = mysqli_query($con, $query1);
  if (mysqli_num_rows($rst) != 0) {
    $row = mysqli_fetch_array($rst);
    $project_title = $row['project_title'];
  }
  return $project_title;
}

function selectRole($id)
{
  include("config/connect.php");
  $rolename = "";
  $query = "SELECT role_name FROM role WHERE role_id='$id'";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_array($result);
    $rolename = $row['role_name'];
  }
  return  $rolename;
}

function selectBarangay($id)
{
  include("config/connect.php");
  $barangayname = "";
  $query = "SELECT barangay_name FROM barangay WHERE barangay_id='$id'";
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) != 0) {
    $row = mysqli_fetch_array($result);
    $barangayname = $row['barangay_name'];
  }
  return  $barangayname;
}

function countResponded()
{
  include("config/connect.php");
  $sql2 = "SELECT COUNT(project_id) as countproj FROM responded_program";
  $rst2 = mysqli_query($con, $sql2);
  if (mysqli_num_rows($rst2) != 0) {
    $row2 = mysqli_fetch_array($rst2);
    $count = $row2['countproj'];
    echo $count;
  }
}

function countOngoing($n)
{
  include("config/connect.php");
  $yearnow = date("Y");
  $sql2 = "SELECT COUNT(project_id) as countproj FROM needs_assessement_recommendation WHERE YEAR(date_created)='$yearnow' AND status='$n'";
  $rst2 = mysqli_query($con, $sql2);
  if (mysqli_num_rows($rst2) != 0) {
    $row2 = mysqli_fetch_array($rst2);
    $count = $row2['countproj'];
    echo $count;
  }
}

function countCompletedProj($n)
{
  include("config/connect.php");
  $yearnow = date("Y");
  $sql2 = "SELECT COUNT(project_id) as countproj FROM needs_assessement_recommendation WHERE YEAR(date_created)='$yearnow' AND status='$n'";
  $rst2 = mysqli_query($con, $sql2);
  if (mysqli_num_rows($rst2) != 0) {
    $row2 = mysqli_fetch_array($rst2);
    $count = $row2['countproj'];
    echo $count;
  }
}

function extensionProjCnt($id)
{
  include("config/connect.php");
  $count = 0;
  $sql = "SELECT count(extension_id) as count FROM extension_project WHERE project_id='$id'";
  $rst = mysqli_query($con, $sql);
  if (mysqli_num_rows($rst) != 0) {
    $row = mysqli_fetch_array($rst);
    $count = $row['count'];
  }
  return $count;
}

function countProgramStat($id, $bid)
{
  include("config/connect.php");
  $count = 0;
  //$cond = strlen($bid)!= 0 ? " AND barangay_id='$bid'"; 
  if (strlen($bid) == 0) {
    $sql = "SELECT count(program_id) as cntprogram FROM `responded_program` WHERE program_id='$id'";
  } else {
    $sql = "SELECT count(program_id) as cntprogram FROM `responded_program` rp INNER JOIn assessment_main_info am ON rp.assessment_id=am.assessment_id WHERE rp.program_id='$id' ANd am.`barangay`= '$bid'";
  }
  $rst = mysqli_query($con, $sql);
  if (mysqli_num_rows($rst) != 0) {
    $row = mysqli_fetch_array($rst);
    $count = $row['cntprogram'];
  }
  return $count;
}

function getAgeBracket($pid, $bid)
{
  include("config/connect.php");
  $count = 0;
  $age_range = "";
  //$cond = strlen($bid)!= 0 ? " AND barangay_id='$bid'"; 

  $sql = "SELECT a.ageinlastbirthday FROM assessment_main_info a RIGHT OUTER JOIN responded_program r ON r.assessment_id=a.assessment_id WHERE r.program_id='$pid' AND r.`barangay`= '$bid' ORDER BY r.id DESC";
  $rst = mysqli_query($con, $sql);
  if (mysqli_num_rows($rst) != 0) {
    $row = mysqli_fetch_array($rst);
    $age_var = $row['ageinlastbirthday'];
  }

  if ($age_var >= 8 and $age_var <= 12) {
    $age_range = "8 to 12 years old";
  } else if ($age_var >= 13 and $age_var <= 19) {
    $age_range = "13 to 19 years old";
  } else if ($age_var >= 20) {
    $age_range = "20 years old and above";
  }

  return $age_range;
}


function getRecentRespond()
{
  include("config/connect.php");

  $sql = "SELECT assessment_main_info.family_name,
  assessment_main_info.first_name, 
  course_category.course_title,
  program.program_title,
  resprogram.intend_beneficiary
  FROM `responded_program` AS resprogram
  INNER JOIN program ON resprogram.program_id = program.program_id
  INNER JOIN course_category 
  ON program.course_id = course_category.course_id 
  INNER JOIN assessment_main_info 
  ON resprogram.assessment_id = assessment_main_info.assessment_id 
  ORDER BY resprogram.date_created DESC";

  $rst = mysqli_query($con, $sql);
  if (mysqli_num_rows($rst) != 0) {
    return $rst;
  }
}
