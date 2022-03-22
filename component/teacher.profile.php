<?php include_once('layout/teacher.nav.php'); ?>
<?php $Teacher = TeacherActionClass::getDataID($_SESSION['uid']); ?>

<hr>
<div class="container">
    <div class="row">
        <div class="col-4 border shadow-sm p-3 m-1">

            <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">รหัสประจำตัวครู</label>
                    <input type="text" disabled class="form-control form-control-sm" value="<?php echo $Teacher[0]['Tc_user'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"> <i class="fa-solid fa-lock"></i> แก้ไขข้อรหัสผ่าน</label>
                    <input type="password" class="form-control form-control-sm" placeholder="*******">
                </div>
                <hr>
                <button type="submit" class="btn btn-primary w-100">แก้ไขรหัสผ่าน</button>
            </form>

        </div>

        <div class="col border shadow-sm p-3 m-1 text-center">
            <?php if ($Teacher[0]['Tc_picture'] !== "" || $Teacher[0]['Tc_picture'] !== null) : ?>
                <img src="https://cdn.pixabay.com/photo/2020/07/14/13/07/icon-5404125_1280.png" style="max-width: 10rem;" alt="">
            <?php else : ?>
                <img src="<?php echo $Teacher[0]['Tc_picture'] ?>" style="max-width: 10rem;" alt="">
            <?php endif; ?>

            <br>
            <span>รหัสประจำตัว : <?php echo $Teacher[0]['Tc_user'] ?></span> <br>
            <span>ชื่อ : <?php echo "{$Teacher[0]['Tc_firstname']} {$Teacher[0]['Tc_lastname']}" ?></span> <br>
            <span>เพศ : <?php echo $Teacher[0]['Tc_sex'] ?></span> <br>
            <span>ประจำวิชา : <?php echo departmentActionClass::getPositionNane($Teacher[0]['Tc_department']) ?></span> <br>
            <span>ตำแหน่ง : <?php echo positionActionClass::getPositionNane($Teacher[0]['Tc_position']) ?></span> <br>

        </div>



    </div>
</div>