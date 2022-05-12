
<?php $studentClass = studentActionClass::getStudentID($_SESSION['uid'])?>
<div class="container mt-5">
    <div class="col-12">
        <a href="?op=student-profile" class="btn btn-outline-secondary">โปรไฟล์</a>
        <a href="?op=student-class&&year=<?php echo (intval(date('Y')) + 543)?>&StdID=<?php echo $_SESSION['uid']?>&Y=<?php echo $studentClass[0]['yearClass']?>&t=1" class="btn btn-outline-secondary">ตารางเรียน</a>
        <a href="?op=student-gpa" class="btn btn-outline-secondary">ผลการเรียน</a>
        <?php include_once('btn.logout.php')?>
    </div>
</div>