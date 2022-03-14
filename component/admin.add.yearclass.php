<?php
include_once('layout/admin.nav.php');

if (isset($_POST['btnSave'])) $resData = adminAddYearclassClass::action();
if (isset($_GET['did'])) $resData = adminAddYearclassClass::updateStatus($_GET['did']);


$yearClassName = null;
if (isset($_GET['id'])) {
    $resData = adminAddYearclassClass::getDataID($_GET['id']);
    if (count($resData) > 0) {
        foreach ($resData as $item) {
            $yearClassName = $item['yearClassName'];
        }
    }
}
$resData = adminAddYearclassClass::getDataAll();
?>

<hr>
<div class="text-end">
    <a href="?op=admin-add-yearclass" class="btn btn-sm btn-outline-success">+เพิ่มใหม่</a>
</div>
<div class="container p-3">
    <div class="text-center">
        <h3>เพิ่มปีการศึกษา</h3>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">ชั้น/ปี</label>
                    <input type="text" required name="yearClassName" class="form-control form-control-sm" value="<?php echo $yearClassName ?>">
                </div>
                <div class="mb-3">
                    <button name="btnSave" class="btn btn-primary btn-sm w-100" type="submit">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row border shadow-sm mt-5 p-1">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ไอดี</th>
                    <th>ชั้น/ปี</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resData as $item) : ?>
                    <tr>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo $item['yearClassName'] ?></td>
                        <td>
                            <a href="?op=admin-add-yearclass&id=<?php echo $item['id'] ?>" class="btn btn-sm btn-success">แก้ไข</a>
                        </td>
                        <td>
                            <a href="?op=admin-add-yearclass&did=<?php echo $item['id'] ?>" onclick="if(!confirm('ฉันต้องการลบรายการนี้!')) return false" class="btn btn-sm btn-danger">ลบ</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>