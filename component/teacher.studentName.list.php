<?php optionclass::checkTeacherStatus() ?>
<?php $yearClass = adminAddYearclassClass::getDataAll() ?>
<?php $Course = adminCourseActionClass::getDataAll() ?>
<?php

if (isset($_POST['btnSave'])) studiedResultClass::addResult();

$Y = null;
$course = null;
$myT = null;
$getyearClass = (intval(date('Y')) + 543);
if (isset($_POST['Y'])) $Y  = $_POST['Y'];
if (isset($_POST['course'])) $course = $_POST['course'];
if (isset($_POST['yearClass'])) $getyearClass = $_POST['yearClass'];
if (isset($_POST['myT'])) $myT = $_POST['myT'];

?>
<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <form action="" method="POST">
                <strong><small>เลือกชั้นปีเพื่อค้นหานักเรียนและลงคะแนน</small></strong>

                <input type="text" name="yearClass" class="form-control form-control-sm" id="" value="<?php echo $getyearClass ?>">

                <br>
                <input type="radio" <?php if( intval($myT) === 1) echo 'checked'?> name="myT" id="myT1" checked value="1">
                <label for="myT1">เทอม 1</label>
                <input type="radio" <?php if( intval($myT) === 2) echo 'checked'?> name="myT" id="myT2" value="2">
                <label for="myT2">เทอม 2</label>

                <select name="Y" class="form-select form-select-sm mt-3" id="">
                    <option selected disabled value="">---เลือกชั้นปีนักเรียน---</option>
                    <?php foreach ($yearClass as $key => $item) : ?>
                        <option <?php if ($Y === $item['id']) echo 'selected' ?> value="<?php echo $item['id'] ?>"><?php echo $item['yearClassName'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="course" class="form-select form-select-sm mt-3" id="">
                    <option selected disabled value="">---เลือกวิชาที่สอน---</option>
                    <?php foreach ($Course as $item) : ?>
                        <option <?php if ($course === $item['course_id']) echo 'selected' ?> value="<?php echo $item['course_id'] ?>"><?php echo $item['course_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <button type="submit" class="btn btn-sm btn-primary w-100"><i class="fa-solid fa-magnifying-glass"></i> ค้นหารายชื่อ</button>
            </form>
        </div>
    </div>

    <?php if (isset($_POST['Y'])) : ?>
        <br><br>
        <strong>**สถานะคะแนน (ร , มส , คะแนน) หากคะแนนไม่ถึงเกณฑ์ระบบจะตัดเกรดเป็น ไม่ผ่าน</strong>
        <br><br>
        <div class="row">
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
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
                            $sql = "SELECT * FROM addclass_data WHERE teacherID = ? AND yearclassID = ? AND course_id = ? AND class_year = ?";
                            $data = array($resData[0]['Tc_id'], $_POST['Y'], $_POST['course'], $_POST['yearClass']);
                            $resData = db_connect::getExecute($sql, $data);

                            if (count($resData) > 0) {
                                $sql = "SELECT * FROM student_table WHERE Std_yearOfStudent LIKE '%" . date('Y') . "%' AND yearClass = ?";
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
                                        <input type="text" name="score[]" placeholder="0" class="w-25" value="<?php echo gpaGetClass::getData($item['Std_user'], $_POST['course'], $_POST['myT'], $_POST['Y'], $_POST['yearClass'])?>">
                                        <input type="hidden" name="studentID[]" value="<?php echo $item['Std_ID'] ?>">

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>

                    <div class="col text-center">

                        <br>
                        <br>

                        <input type="hidden" name="Y" value="<?php echo $_POST['Y'] ?>">
                        <input type="hidden" name="course" value="<?php echo $_POST['course'] ?>">
                        <input type="hidden" name="year" value="<?php echo $_POST['yearClass'] ?>">
                        <input type="hidden" name="yearClass" value="<?php echo $_POST['yearClass'] ?>">
                        <input type="hidden" name="myT" value="<?php echo $_POST['myT'] ?>">
                        

                        <button name="btnSave" class="btn btn-primary btn-sm w-50">บันทึกคะแนน</button>
                    </div>

                    <br>
                    <br>

                </form>
            </div>
        </div>
    <?php endif; ?>
</div>