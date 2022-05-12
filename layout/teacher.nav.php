

<div class="container mt-5">
    <div class="col-12">
        <a href="?op=teacher-profile" class="btn btn-outline-secondary">โปรไฟล์</a>
        <a href="?op=teacher-studentName-list" class="btn btn-outline-secondary">รายชื่อนักเรียน</a>
        <a href="?op=teacher-class&Y=<?php echo (intval(date('Y')) + 543) ?>&t=1" class="btn btn-outline-secondary">ตารางสอน</a>
        <?php include_once('btn.logout.php')?>
    </div>
</div>