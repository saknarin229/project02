<!-- studied.result.class.php -->

<?php

if (isset($_POST['btnSave'])) studiedResultClass::addResult();

$groupClass =  hex2bin($_GET['groupClass']);
$groupClass = json_decode($groupClass);
foreach ($groupClass as $key => $item) {
    $$key = $item;
}

$stdID = studentActionClass::getStudentID($_GET['stdID']);
$data = studiedResultClass::checkStudentID($_GET['stdID'], $Y, $course, $myT, $yearClass);

$midtermExamScores = null;
$FinalExamScores = null;
$midtermScore = null;
$FinalScore = null;
$mentalityExamScore = null;
$mentalityScore = null;

if(count($data) > 0){
    $midtermExamScores = $data[0]['midterm_exam_scores'];
    $FinalExamScores = $data[0]['Final_exam_scores'];
    $midtermScore = $data[0]['midterm_score'];
    $FinalScore = $data[0]['Final_score'];
    $mentalityExamScore = $data[0]['mentality_exam_score'];
    $mentalityScore = $data[0]['mentality_score'];
}


?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <strong>ลงคะแนน</strong>
            <?php if ($stdID[0]['Std_image'] !== null) : ?>
                <img src="<?php echo $stdID[0]['Std_image'] ?>" alt="" style="width: 50rem;">
                <br>
            <?php endif; ?>

            <p>รหัสนักเรียน : <?php echo $stdID[0]['Std_ID'] ?></p>
            <p><?php echo $stdID[0]['Std_firstname'] ?> <?php echo $stdID[0]['Std_lastname'] ?></p>
        </div>
        <div class="col-8">
            <form action="" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="Y" value="<?php echo $Y ?>">
                <input type="hidden" name="course" value="<?php echo $course ?>">
                <input type="hidden" name="year" value="<?php echo $yearClass ?>">
                <input type="hidden" name="yearClass" value="<?php echo $yearClass ?>">
                <input type="hidden" name="myT" value="<?php echo $myT ?>">

                <div class="mb-3">
                    <label for="" class="form-label">คะแนนเก็บกลางภาค</label>
                    <input type="number" name="midterm-exam-scores" value="<?php echo $midtermExamScores?>" class="form-control form-control-sm">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">คะแนนสอบกลางภาค</label>
                    <input type="number" name="Final-exam-scores" value="<?php echo $FinalExamScores?>" class="form-control form-control-sm">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">คะแนนจิตพิสัยกลางภาค</label>
                    <input type="number"  name="mentality-exam-score" value="<?php echo $mentalityExamScore?>" class="form-control form-control-sm">
                </div>
                <hr>                
                <div class="mb-3">
                    <label for="" class="form-label">คะแนนเก็บปลายภาค</label>
                    <input type="number" name="midterm-score" value="<?php echo $midtermScore?>" class="form-control form-control-sm">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">คะแนนสอบปลายภาค</label>
                    <input type="number"  name="Final-score" value="<?php echo $FinalScore?>" class="form-control form-control-sm">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">คะแนนจิตพิสัยปลายภาค</label>
                    <input type="number"  name="mentality-score" value="<?php echo $mentalityScore?>" class="form-control form-control-sm">
                </div>
                
                <hr>
                <button type="submit" name="btnSave" class="btn w-100 btn-primary">บันทึกคะแนน</button>
            </form>
        </div>
    </div>
</div>