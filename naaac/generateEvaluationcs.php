<?php 
require "libs/autoload.php";

use \PhpOffice\PhpWord\PhpWord;

// Creating the new document...
$phpWord = new PhpWord();
$phpWord->setDefaultFontName('Times New Roman');
$phpWord->setDefaultFontSize(12);
$section = $phpWord->addSection();


$section->addTextBreak(5);
/*$section->addImage(
    'assets/img/.png',
    array(
        'width'         => 150,
        'height'        => 150,
        'marginTop'     => -1,
        'marginLeft'    => -1,
        'wrappingStyle' => 'behind',
        'align' => 'center'
    )
); */


//place the word template to directory "template"
$document = $phpWord->loadTemplate('template/evaluation-of-proposed-extension-project.docx');
$barangayname = "";
$projid = isset($_REQUEST['id']) ? $_REQUEST['id']:"";
$recoid = isset($_REQUEST['recoid']) ? $_REQUEST['recoid']:"";
$bid = isset($_REQUEST['bid']) ? $_REQUEST['bid']:"";
$project_leader = "";
$members = "";
$college_schoolname = "";
$comments = "";
$evaluator_name = "";
$refdate = "";

if (strlen($bid) !=0){
$query1 = "SELECT * FROM barangay WHERE barangay_id='$bid'";
$rst = mysqli_query($con, $query1);
    if (mysqli_num_rows($rst)!=0){
        $row = mysqli_fetch_array($rst);
        $barangayname = strtoupper($row['barangay_name']);
    }
}

if (strlen($projid)!=0){
    $project = selectProject($projid);
}

if (strlen($recoid) !=0){
$sql2 = "SELECT * FROM project_evaluation WHERE reco_id='$recoid'";
$rst2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($rst2)!=0){  
      $row2 = mysqli_fetch_array($rst2);
      $project_leader = strtoupper($row2['project_leader']);
      $college_schoolname = strtoupper($row2['college_school_name']); 
      $members = $row2['members'];
      $barangayid =  $row2['barangay'];
      //$personel_involved = $row2['personel_involved'];
      //$start_date = $row2['project_start_date'];
      //$end_date = $row2['project_end_date']; 
     // $project_time = $row2['project_time'];
     // $age_bracket = $row2['age_bracket'];
      $total_score = ($row2['total_score']==NULL) ? 0:$row2['total_score'];
      $evaluator_name = strtoupper($row2['evaluator_name']);
      $refdate = date("F d, Y", strtotime($row2['reference_date']));
      $comments = ucwords($row2['comments']);

    }
}
//set variable like this
$document->setValue('year',date("Y"));
$document->setValue('barangayname',$barangayname);
$document->setValue('project_title',$project);
$document->setValue('project_leader',$project_leader);
$document->setValue('members',$members);
$document->setValue('college_school',$college_schoolname);
$document->setValue('comments',$comments);
$document->setValue('evaluator_name',$evaluator_name);
$document->setValue('refdate',$refdate);

$filename = "evaluation-of-proposed-extension-project for ".$barangayname."-".date("YmdHis").".docx";
// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//$objWriter->saveAs("docxs/".$filename);
$document->saveAs("docxs/".$filename);

?>
<section class="wrapper bg-gray">
  <div class="container">
    <div class="row">
    
        <div class="col-xl-10 order-xl-2">  
            <section id="snippet-1" class="wrapper pt-6 pb-8">

                <h2 class="mb-5"><a href="main.php?action=needsassessment2proposal&projectid=<?php echo $projid ?>&brgyid=<?php echo $barangay_id ?>"><i class="uil uil-angle-left"></i></a>Generate Docx File</h2>
                <div class="card">
                    <div class="card-body text-center">  
                        <h3>Project: <?php echo $project;?><h3>
                        <h4>Evaluation .docx file has been successfully generated.</h4><br/>
                        <a href="<?php echo "docxs/".$filename;?>" class="btn btn-primary rounded rounded-pill">Download</a>

                    </div>

                </div>

            </section>           
        </div>        
  </div>
  <!-- /.container -->
</section>
<!-- /section -->                       
