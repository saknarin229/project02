<?php optionclass::checkAdminStatus()?>

<?php

if (isset($_POST['btnSave'])) adminCourseActionClass::actionData();



$course_id = null;
$course_name = null;
$course_credit = null;
if(isset($_GET['id'])) {
    $resData = adminCourseActionClass::getDataID($_GET['id']);
    if(count($resData) > 0){
        foreach($resData as $item){
            $course_id = $item['course_id'];
            $course_name = $item['course_name'];
            $course_credit = $item['course_credit'];            
        }
    }
}

if(isset($_GET['did'])) adminCourseActionClass::updateStatus($_GET['did']);
$resData = adminCourseActionClass::getDataAll();

?>


<div class="text-end">
    <a href="?op=admin-add-student" class="btn btn-sm btn-outline-success">+เพิ่มใหม่</a>
</div>
<div class="container p-3">
    <div class="text-center">
        <h3>เพิ่มรายวิชา</h3>
    </div>
    <form action="" enctype="multipart/form-data" method="post">
        <div class="row justify-content-center">

            <div class="col-6">             
                <div class="mb-3">
                    <label class="form-label">รหัสวิชา</label>
                    <input type="text" required name="course_id" class="form-control form-control-sm" value="<?php echo $course_id ?>">
                </div>                                 
                <div class="mb-3">
                    <label class="form-label">วิชา</label>
                    <input type="text" required name="course_name" class="form-control form-control-sm" value="<?php echo $course_name ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">หน่วยกิต</label>
                    <input type="text" required name="course_credit" class="form-control form-control-sm" value="<?php echo $course_credit ?>">
                </div>                
                <div class="mb-3">
                    <button type="submit" name="btnSave" class="btn btn-sm btn-primary w-100">บันทึกข้อมูล</button>
                </div>
            </div>

        </div>
    </form>

    <div class="row border shadow-sm mt-5 p-1">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>รหัสรายวิชา</th>
                    <th>ชื้อรายวิชา</th>
                    <th>หน่วยกิต</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resData as $item) : ?>
                    <tr>
                        <td><?php echo $item['course_id'] ?></td>
                        <td><?php echo $item['course_name'] ?></td>
                        <td><?php echo $item['course_credit'] ?></td>
                        <td>
                            <a href="?op=admin-add-course&id=<?php echo $item['course_id'] ?>" class="btn btn-sm btn-success">แก้ไข</a>
                        </td>
                        <td>
                            <a href="?op=admin-add-course&did=<?php echo $item['course_id'] ?>" onclick="if(!confirm('ฉันต้องการลบรายการนี้!')) return false" class="btn btn-sm btn-danger">ลบ</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>