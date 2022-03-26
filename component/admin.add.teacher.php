<?php

if (isset($_POST['btnSave'])) TeacherActionClass::actionData();


$Tc_firstname = null;
$Tc_lastname = null;
$Tc_user = null;
$Tc_department = null;
$Tc_sex = null;
$Tc_position = null;
$Tc_picture = null;
if (isset($_GET['id'])) {
    $Teacher = TeacherActionClass::getDataID($_GET['id']);
    if (count($Teacher) > 0) {
        foreach ($Teacher as $item) {
            $Tc_picture = $item['Tc_picture'];
            $Tc_firstname = $item['Tc_firstname'];
            $Tc_lastname = $item['Tc_lastname'];
            $Tc_user = $item['Tc_user'];
            $Tc_department = $item['Tc_department'];
            $Tc_sex = $item['Tc_sex'];
            $Tc_position = $item['Tc_position'];
        }
    }
}
$Teacher = TeacherActionClass::getDataAll();

?>


<div class="text-end">
    <a href="?op=admin-add-teacher&status=add" class="btn btn-sm btn-outline-success">+เพิ่มรายชื่อครู</a>
</div>
<div class="container p-3">
    <div class="text-center">
        <h3>เพิ่มรายชื่อครู</h3>
    </div>
    <?php if (isset($_GET['status'])) : ?>
        <form action="" enctype="multipart/form-data" method="post">
            <div class="row justify-content-center">

                <div class="col-6">
                    <?php if ($Tc_picture !== null && $Tc_picture !== "") : ?>
                        <div class="mb-3 position-relative">
                            <img src="<?php echo $Tc_picture ?>" class="w-25" alt="">
                            <div class="position-absolute top-0 end-0">
                                <a onclick="if(!confirm('ฉันต้องการลบภาพนี้!')) return false" href="javascript:void(0)" class="text-danger">ลบ</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label class="form-label">โปรไฟล์</label>
                        <input type="file" class="form-control form-control-sm" accept="image/*" name="Tc_picture" id="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" required name="Tc_firstname" class="form-control form-control-sm" value="<?php echo $Tc_firstname ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">สกุล</label>
                        <input type="text" required name="Tc_lastname" class="form-control form-control-sm" value="<?php echo $Tc_lastname ?>">
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label">รหัสครู</label>
                        <input type="text" required name="Tc_user" class="form-control form-control-sm" value="<?php echo $Tc_user ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ประจำฝ่ายวิชา</label>

                        <?php $Deparment = departmentActionClass::getDeparmentAll(); ?>
                        <select required class="form-select form-select-sm" name="Tc_department" id="">
                            <?php foreach ($Deparment as $item) : ?>
                                <option <?php if ($Tc_department === $item['id']) echo 'selected' ?> value="<?php echo $item['id'] ?>"><?php echo $item['subjectName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">เพศ</label>
                        <select required name="Tc_sex" class="form-select form-select-sm">
                            <option <?php if ($Tc_sex === 'ชาย') echo 'selected' ?> value="ชาย">ชาย</option>
                            <option <?php if ($Tc_sex === 'หญิง') echo 'selected' ?> value="หญิง">หญิง</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ตำแหน่ง</label>
                        <?php $Position = positionActionClass::getPositionAll() ?>
                        <select required class="form-select form-select-sm" name="Tc_position" id="">
                            <?php foreach ($Position as $item) : ?>
                                <option <?php if ($Tc_position === $item['id']) echo 'selected' ?> value="<?php echo $item['id'] ?>"><?php echo $item['positionName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <button type="submit" name="btnSave" class="btn btn-sm btn-primary w-100">บันทึกข้อมูล</button>
                    </div>
                </div>

            </div>
        </form>
    <?php else : ?>

        <div class="row border shadow-sm mt-5 p-1">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ไอดี</th>
                        <th>ชื้อครู</th>
                        <th>รหัสครู</th>
                        <th>เพศ</th>
                        <th>ประจำฝ่ายวิชา</th>
                        <th>ตำแหน่ง</th>
                        <th>ตารางสอน</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Teacher as $item) : ?>
                        <tr>
                            <td><?php echo $item['Tc_id'] ?></td>
                            <td><?php echo "{$item['Tc_firstname']} {$item['Tc_lastname']}" ?></td>
                            <td><?php echo $item['Tc_user'] ?></td>
                            <td><?php echo $item['Tc_sex'] ?></td>
                            <td><?php echo departmentActionClass::getPositionNane($item['Tc_department']) ?></td>
                            <td><?php echo positionActionClass::getPositionNane($item['Tc_position']) ?></td>
                            <td>
                                <a href="?op=admin-showClass-teacher&year=<?php echo (intval(date('Y')) + 543) ?>&TcId=<?php echo $item['Tc_user'] ?>&Y=1">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </td>
                            <td>
                                <a href="?op=admin-add-teacher&id=<?php echo $item['Tc_user'] ?>&status=edit" class="btn btn-sm btn-success">แก้ไข</a>
                            </td>
                            <td>
                                <a href="?op=admin-add-teacher&did=<?php echo $item['Tc_user'] ?>" onclick="if(!confirm('ฉันต้องการลบรายการนี้!')) return false" class="btn btn-sm btn-danger">ลบ</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>
</div>