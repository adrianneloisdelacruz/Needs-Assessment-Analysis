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
$document = $phpWord->loadTemplate('template/project-proposalbscs.docx');
$barangayname = "";
$projectid = $_REQUEST['projectid']; //project id
$bid = $_REQUEST['bid']; //barangay id
$pid = $_REQUEST['pid']; //program id
$idate =  $_REQUEST['idate']; //date of implementation
$idates = date('F d, Y', strtotime($idate));
$query1 = "SELECT * FROM barangay WHERE barangay_id='$bid'";
$rst = mysqli_query($con, $query1);
if (mysqli_num_rows($rst)!=0){
    $row = mysqli_fetch_array($rst);
    $barangayname = strtoupper($row['barangay_name']);
}

$sql = "SELECT * FROM responded_program WHERE program_id='$pid' ORDER by id DESC";
$rst1 = mysqli_query($con, $sql);

if (mysqli_num_rows($rst1)!=0){
    $row = mysqli_fetch_array($rst1);
    $projectid = $row['project_id'];
}

if ($projectid != ""){
    $update = "UPDATE needs_assessement_recommendation SET project_id='$projectid' WHERE program_id='$pid' AND barangay_id='$bid'";
    $rst = mysqli_query($con, $update);
}

$project = selectProject($projectid);

//set variable like this
$document->setValue('year',date("Y"));
$document->setValue('idate',$idates);
$document->setValue('barangayname',$barangayname);
$document->setValue('project_title',$project);

$filename = "Project Proposal for ".$barangayname.date("YmdHis").".docx";
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

                <h2 class="mb-5"><a href="main.php?action=needsassessment2proposalcs&projectid=<?php echo $projectid ?>&bid=<?php echo $barangay_id ?>"><i class="uil uil-angle-left"></i></a>Generate Proposal Docx File For BSCS</h2>
                <div class="card">
                    <div class="card-body text-center">  
                        <h3><?php //echo $project;?><h3>
                        <h4>Proposal file has been successfully generated.</h4><br/>
                        <a href="<?php echo "docxs/".$filename;?>" class="btn btn-primary rounded rounded-pill">Download</a>

                    </div>

                </div>

            </section>           
        </div>        
  </div>
  <!-- /.container -->
</section>
<!-- /section -->                       
