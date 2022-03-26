
<?php $student = studentActionClass::getStudentID($_SESSION['uid']); ?>
<?php if(isset($_POST['btnSavePassword'])) studentActionClass::EditPassword($_POST['password'], $_SESSION['uid']);?>



<div class="container">
    <div class="row">
        <div class="col-4 border shadow-sm p-3 m-1">

            <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">รหัสประจำตัวนักเรียน</label>
                    <input type="text" disabled class="form-control form-control-sm" value="<?php echo $student[0]['Std_user'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"> <i class="fa-solid fa-lock"></i> แก้ไขรหัสผ่าน</label>
                    <input type="password" name="password" class="form-control form-control-sm" placeholder="*******">
                </div>
                <hr>
                <button type="submit" name="btnSavePassword" class="btn btn-primary w-100">แก้ไขรหัสผ่าน</button>
            </form>

        </div>

        <div class="col border shadow-sm p-3 m-1 text-center">
            <?php if ($student[0]['Std_image'] === "" || $student[0]['Std_image'] === null) : ?>
                <img src="https://cdn.pixabay.com/photo/2020/07/14/13/07/icon-5404125_1280.png" style="max-width: 10rem;" alt="">
            <?php else : ?>
                <img src="<?php echo $student[0]['Std_image'] ?>" style="max-width: 10rem;" alt="">
            <?php endif; ?>

            <br>
            <span>รหัสประจำตัว : <?php echo $student[0]['Std_user'] ?></span> <br>
            <span>ชื่อ : <?php echo "{$student[0]['Std_firstname']} {$student[0]['Std_lastname']}" ?></span> <br>
            <span>เพศ : <?php echo $student[0]['Std_sex'] ?></span> <br>
            <span>ชั้น : <?php $Yearclass = adminAddYearclassClass::getDataID($student[0]['yearClass']); echo $Yearclass[0]['yearClassName'] ?></span> <br>

        </div>



    </div>
</div>