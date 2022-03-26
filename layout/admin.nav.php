<?php optionclass::checkAdminStatus()?>

<div class="container mt-5">
    <div class="col-12">
        <a href="?op=admin-add-student" class="btn btn-outline-secondary">รายชื่อนักเรียน</a>
        <a href="?op=admin-add-teacher" class="btn btn-outline-secondary">รายชื่อครู</a> 
        <a href="?op=admin-add-course" class="btn btn-outline-secondary">วิชา</a>        
        <a href="?op=admin-add-yearclass" class="btn btn-outline-secondary">ปีการศึกษา</a>
        <a href="?op=admin-add-class" class="btn btn-outline-secondary">จัดการตารางเรียน</a>
        <?php include_once('btn.logout.php')?>
    </div>
</div>