<?php include_once('layout/teacher.nav.php'); ?>
<?php $yearClass = adminAddYearclassClass::getDataAll() ?>
<?php
$Y = null;
if (isset($_POST['Y'])) {
    $Y  = $_POST['Y'];
}
?>
<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <form action="" method="POST">
                <strong><small>เลือกชั้นปีเพื่อค้นหานักเรียนและลงคะแนน</small></strong>
                <select name="Y" class="form-select form-select-sm" id="">
                    <option selected disabled value="">---เลือกชั้นปีนักเรียน---</option>
                    <?php foreach ($yearClass as $key => $item) : ?>
                        <option <?php if ($Y === $item['id']) echo 'selected' ?> value="<?php echo $item['id'] ?>"><?php echo $item['yearClassName'] ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <button type="submit" class="btn btn-sm btn-primary w-100"><i class="fa-solid fa-magnifying-glass"></i> ค้นหารายชื่อ</button>
            </form>
        </div>
    </div>

    <?php if (isset($_POST['Y'])) : ?>
        <br><br>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead class="bg-secondary">
                            <tr>
                                <th>รหัสนักเรียน</th>
                                <th>ชื้อนักเรียน</th>
                                <th>ชั้น</th>
                                <th class="text-center">ลงคะแนน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $resData = TeacherActionClass::getDataID($_SESSION['uid']);
                            $sql = "SELECT * FROM `addclass_data` WHERE `teacherID` = ? AND `yearclassID` = ?";
                            $data = array($resData[0]['Tc_id'], $_POST['Y']);
                            $resData = db_connect::getExecute($sql, $data);

                            if (count($resData) > 0) {
                                $sql = "SELECT * FROM `student_table` WHERE Std_yearOfStudent LIKE '%" . date('Y') . "%' AND `yearClass` = ?";
                                $data = array($resData[0]['yearclassID']);
                                $resData = db_connect::getExecute($sql, $data);
                            }

                            foreach ($resData as $item) :
                            ?>
                                <tr>
                                    <td><?php echo $item['Std_user'] ?></td>
                                    <td><?php echo "{$item['Std_firstname']} {$item['Std_lastname']}" ?></td>
                                    <td><?php $resVearClass = adminAddYearclassClass::getDataID($item['yearClass']);
                                        echo $resVearClass[0]['yearClassName']; ?></td>
                                    <td class="text-center">
                                        <input type="text" placeholder="0" class="w-25">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="col text-center">
                        <input type="radio" name="myT" id="myT1" checked value="1">
                        <label for="myT1">เทรม 1</label>
                        <input type="radio" name="myT" id="myT2" value="2">
                        <label for="myT2">เทรม 2</label>
                        <br>
                        <br>
                        <button class="btn btn-primary btn-sm w-50">บันทึกคะแนน</button>
                    </div>

                    <br>
                    <br>
                    
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>