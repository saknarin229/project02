<?php optionclass::checkTeacherStatus() ?>
<?php $yearClass = adminAddYearclassClass::getDataAll() ?>
<?php $Course = adminCourseActionClass::getDataAll() ?>
<?php

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
                <input type="radio" <?php if (intval($myT) === 1) echo 'checked' ?> name="myT" id="myT1" checked value="1">
                <label for="myT1">เทอม 1</label>
                <input type="radio" <?php if (intval($myT) === 2) echo 'checked' ?> name="myT" id="myT2" value="2">
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
                                <th><small>ไอดี</small></th>
                                <th><small>ชื้อ</small></th>
                                <th><small>ชั้น</small></th>
                                <td><small style="font-size: 12px;"><strong>ก.กล.ภ</strong></small></td>
                                <td><small style="font-size: 12px;"><strong>ส.กล.ภ</strong></small></td>
                                <td><small style="font-size: 12px;"><strong>จ.ส.กล</strong></small></td>
                                <td><small style="font-size: 12px;"><strong>รวม</strong></small></td>
                                <td><small style="font-size: 12px;"><strong>ก.ปล.ภ</strong></small></td>
                                <td><small style="font-size: 12px;"><strong>ส.ปล.ภ</strong></small></td>
                                <td><small style="font-size: 12px;"><strong>จ.ส.ปล</strong></small></td>
                                <td><small style="font-size: 12px;"><strong>รวม</strong></small></td>
                                <td><small style="font-size: 12px;"><strong>คะแนน</strong></small></td>
                                <th><small>ลงคะแนน</small></th>
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


                            $groupClass = array(
                                'Y' => $_POST['Y'],
                                'course' => $_POST['course'],
                                'year' => $_POST['yearClass'],
                                'yearClass' => $_POST['yearClass'],
                                'myT' => $_POST['myT'],
                            );

                            $json = bin2hex(json_encode($groupClass));

                            foreach ($resData as $item) :
                            ?>
                                <tr>
                                    <td> <small><?php echo $item['Std_user'] ?></small></td>
                                    <td> <small><?php echo "{$item['Std_firstname']} {$item['Std_lastname']}" ?></small></td>
                                    <td>
                                        <small>
                                            <?php $resVearClass = adminAddYearclassClass::getDataID($item['yearClass']);
                                            echo $resVearClass[0]['yearClassName']; ?>
                                        </small>
                                    </td>
                                    <?php
                                    $sc = gpaGetClass::getDataNew($item['Std_user'], $_POST['course'], $_POST['myT'], $_POST['Y'], $_POST['yearClass']);

                                    $midterm_exam_scores = 0;
                                    $Final_exam_scores = 0;
                                    $midterm_score = 0;
                                    $Final_score = 0;
                                    $mentality_exam_score = 0;
                                    $mentality_score = 0;
                                    $gpa = 0;

                                    if (count($sc) > 0) {
                                        $midterm_exam_scores = $sc[0]['midterm_exam_scores'];
                                        $Final_exam_scores = $sc[0]['Final_exam_scores'];
                                        $midterm_score = $sc[0]['midterm_score'];
                                        $Final_score = $sc[0]['Final_score'];
                                        $mentality_exam_score = $sc[0]['mentality_exam_score'];
                                        $mentality_score = $sc[0]['mentality_score'];
                                        $gpa = $sc[0]['gpa'];
                                    }

                                    ?>
                                    <td><?php echo $midterm_exam_scores ?></td>
                                    <td><?php echo $Final_exam_scores ?></td>
                                    <td><?php echo $mentality_exam_score ?></td>
                                    <td><?php echo number_format(((floatval($midterm_exam_scores) + floatval($Final_exam_scores)) + floatval($mentality_exam_score)) / 2, 1) ?></td>
                                    <td><?php echo $midterm_score ?></td>
                                    <td><?php echo $Final_score ?></td>
                                    <td><?php echo $mentality_score ?></td>
                                    <td><?php echo number_format(((floatval($midterm_score) + floatval($Final_score)) + floatval($mentality_score)) / 2, 1) ?></td>
                                    <td><?php echo $gpa ?></td>
                                    <td>
                                        <a href="?op=teacher-score-add&stdID=<?php echo $item['Std_ID'] ?>&groupClass=<?php echo $json ?>">
                                            <i class="fa-solid fa-file-circle-plus"></i><!-- ลงคะแนน -->
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>

                    <br>
                    <br>

                </form>
            </div>
        </div>
    <?php endif; ?>
</div>