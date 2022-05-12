<?php optionclass::checkAdminStatus()?>

<?php

if (isset($_POST['btnSave'])) studentActionClass::actionData();
if (isset($_GET['did'])) studentActionClass::updateStatus($_GET['did']);

$Std_firstname = null;
$Std_lastname = null;
$Std_user = null;
$Std_sex = null;
$Std_yearOfStudent = null;
$Std_image = null;
$yearClass = null;

if (isset($_GET['id'])) {
    $resData = studentActionClass::getStudentID($_GET['id']);
    if (count($resData) > 0) {
        foreach ($resData as $item) {
            $Std_firstname = $item['Std_firstname'];
            $Std_lastname = $item['Std_lastname'];
            $Std_user = $item['Std_user'];
            $Std_sex = $item['Std_sex'];
            $Std_yearOfStudent = $item['Std_yearOfStudent'];
            $Std_image = $item['Std_image'];
            $yearClass = $item['yearClass'];
        }
    }
}

if(isset($_POST['btnSearch'])){
    $year = $_POST['year'];
    $resData = studentActionClass::getStudentYearAll($_POST['year']);
}else{
    $year = date('Y');
    $resData = studentActionClass::getStudentYearAll(date('Y'));
}


$resDataYearClass = adminAddYearclassClass::getDataAll();

?>


<div class="text-end">
    <a href="?op=admin-add-student&status=add" class="btn btn-sm btn-outline-success">+เพิ่มรายชื่อนักเรียน</a>
</div>
<div class="container p-3">
    <div class="text-center">
        <h3>เพิ่มรายชื่อนักเรียน</h3>
    </div>
    <?php if(isset($_GET['status'])):?>
    <form action="" enctype="multipart/form-data" method="post">
        <div class="row justify-content-center">
            <div class="col-6">
                <?php if($Std_image !== null || $Std_image !== ""):?>
                    <div class="mb-3">
                        <img src="<?php echo $Std_image ?>" class="w-25" alt="">
                    </div>
                <?php endif;?>
                <div class="mb-3">
                    <label class="form-label">โปรไฟล์</label>
                    <input type="file" class="form-control form-control-sm" accept="image/*" name="myfile" id="">
                </div>                
                <div class="mb-3">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" required name="Std_firstname" class="form-control form-control-sm" value="<?php echo $Std_firstname ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">สกุล</label>
                    <input type="text" required name="Std_lastname" class="form-control form-control-sm" value="<?php echo $Std_lastname ?>">
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label">รหัสนักเรียน</label>
                    <input type="text" required name="Std_user" class="form-control form-control-sm" value="<?php echo $Std_user ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">ชั้นเรียน</label>
                    <?php 
                        $yearclass = adminAddYearclassClass::getDataAll();
                    ?>
                    <select class="form-select form-select-sm" name="yearClass">
                        <option selected disabled value="">---เลือกชั้นเรียน---</option>
                        <?php foreach($yearclass as $item):?>
                        <option <?php if($yearClass === $item['id']) echo 'selected' ?> value="<?php echo $item['id']?>"><?php echo $item['yearClassName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>                
                <div class="mb-3">
                    <label class="form-label">เพศ</label>
                    <select required name="Std_sex" class="form-select form-select-sm">
                        <option <?php if ($Std_sex === 'ชาย') echo 'selected' ?> value="ชาย">ชาย</option>
                        <option <?php if ($Std_sex === 'หญิง') echo 'selected' ?> value="หญิง">หญิง</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">วันเข้าปีการศึกษา</label>
                    <input required type="date" name="Std_yearOfStudent" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" name="btnSave" class="btn btn-sm btn-primary w-100">บันทึกข้อมูล</button>
                </div>
            </div>

        </div>
    </form>

    <?php else:?>

    <div class="row border shadow-sm mt-5 p-1">
        <div class="d-flex justify-content-start">
            <form action="" enctype="multipart/form-data" method="post">
                <input type="text" name="year" value="<?php echo $year?>" placeholder="ค้นหาปีการศึกษา ค.ศ."> <button type="submit" name="btnSearch" class="btn btn-sm btn-primary">ค้นหา</button>
            </form>
        </div>
        <hr>
        <br><br>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ไอดี</th>
                    <th>ชื้อนักเรียน</th>
                    <th>รหัสนักเรียน</th>
                    <th>เพศ</th>
                    <th>วันเข้าปีการศึกษา</th>
                    <th>ตารางเรียน</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resData as $item) : ?>
                    <tr>
                        <td><?php echo $item['Std_ID'] ?></td>
                        <td><?php echo "{$item['Std_firstname']} {$item['Std_lastname']}" ?></td>
                        <td><?php echo $item['Std_user'] ?></td>
                        <td><?php echo $item['Std_sex'] ?></td>
                        <td><?php echo optionclass::DateThai($item['Std_yearOfStudent']);?></td>
                        <td>
                            <a href="?op=admin-showClass-student&year=<?php echo (intval(date('Y')) + 543)?>&StdID=<?php echo $item['Std_ID']?>&Y=<?php echo $item['yearClass'];?>">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </td>
                        <td>
                            <a href="?op=admin-add-student&id=<?php echo $item['Std_user'] ?>&status=edit" class="btn btn-sm btn-success">แก้ไข</a>
                        </td>
                        <td>
                            <a href="?op=admin-add-student&did=<?php echo $item['Std_user'] ?>" onclick="if(!confirm('ฉันต้องการลบรายการนี้!')) return false" class="btn btn-sm btn-danger">ลบ</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php endif;?>
</div>