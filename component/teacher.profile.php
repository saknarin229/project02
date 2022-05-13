<?php optionclass::checkTeacherStatus() ?>
<?php $Teacher = TeacherActionClass::getDataID($_SESSION['uid']); ?>

<?php if(isset($_POST['btnSavePassword'])) TeacherActionClass::updatePassword($_SESSION['uid'], $_POST['password']);?>

<div class="container">
    
    <div class="row">
        <div class="col-12">
        <?php 
            $year = isset($_POST['myYear']) ? $_POST['myYear'] : (intval(date('Y')) + 543);
        ?>
        <label for="">ค้นหาปีคะแนนประเมินการสอน</label>
        <form action="" method="post" class="d-flex">
            <input type="number" name="myYear" class="form-control w-25 form-control-sm" value="<?php echo $year?>">
            <button type="submit" class="btn btn-success btn-sm">เลือก</button>
        </form>
        <?php
            $sql = "SELECT * FROM teacher_rate_data WHERE tc_id = ? AND year = ?";
            $te = TeacherActionClass::getDataID($_SESSION['uid']);
            $data = array($te[0]['Tc_id'], $year);
            $request = db_connect::getExecute($sql, $data);
            $i = 0;
            $c = count($request) * 5;
            if(count($request) > 0){
                foreach($request as $key=>$item){
                    $i += floatval($item['rate']) * 5;
                }
            }
        ?>
        <?php if($i !== 0):?>
        <br>
        1.0=ดี | 2.0=ดีมาก | 3.0=ปานกลาง | 4.0=เยี่ยม | 5.0=ยอดเยี่ยม
        <h3 class="text-success"><small>ปี พ.ศ. <?php echo $year ?> คะแนนประเมินการสอนได้ </small> (<?php echo number_format(($i/$c), 1)?>) </h3>
        <?php endif; ?>
        </div>

        <div class="col-4 border shadow-sm p-3 m-1">

            <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">รหัสประจำตัวครู</label>
                    <input type="text" disabled class="form-control form-control-sm" value="<?php echo $Teacher[0]['Tc_user'] ?>">
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
            <?php if ($Teacher[0]['Tc_picture'] === "" || $Teacher[0]['Tc_picture'] === null) : ?>
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