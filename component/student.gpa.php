<?php optionclass::checkStudantStatus() ?>
<?php $getYearClass = adminAddYearclassClass::getDataAll() ?>

<?php

$Y = null;
$myT = null;
$getyearClass = (intval(date('Y')) + 543);
if (isset($_POST['myT'])) $myT = $_POST['myT'];
if (isset($_POST['yearclassID'])) $Y  = $_POST['yearclassID'];
if (isset($_POST['yearClass'])) $getyearClass = $_POST['yearClass'];
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 border">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ปีการศึกษา</label>
                    <input type="text" class="form-control form-control-sm" name="yearClass" id="" value="<?php echo $getyearClass ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">ชั้นปี</label>
                    <select name="yearclassID" class="form-select form-select-sm" id="yearclassID">
                        <option value="" selected disabled>---เลือกชั้นปี---</option>
                        <?php foreach ($getYearClass as $item) : ?>
                            <option <?php if ($Y === $item['id']) echo 'selected' ?> value="<?php echo $item['id'] ?>">
                                <?php echo $item['yearClassName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="radio" <?php if (intval($myT) === 1) echo 'checked' ?> name="myT" id="myT1" checked value="1">
                    <label for="myT1">เทอม 1</label>
                    <input type="radio" <?php if (intval($myT) === 2) echo 'checked' ?> name="myT" id="myT2" value="2">
                    <label for="myT2">เทอม 2</label>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100" name="btnS">ค้นหา</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (isset($_POST['btnS'])) : ?>

    <div class="container mt-5">
        <div class="row">
            <cdiv class="col">

                <table class="table table-striped border shadow-sm">
                    <thead class="bg-secondary">
                        <tr>
                            <th>รหัสวิชา</th>
                            <th>วิชา</th>
                            <th>หน่วยกิต</th>
                            <td><small style="font-size: 12px;"><strong>ก.กล.ภ</strong></small></td>
                            <td><small style="font-size: 12px;"><strong>ส.กล.ภ</strong></small></td>
                            <td><small style="font-size: 12px;"><strong>จ.ส.กล</strong></small></td>
                            <td><small style="font-size: 12px;"><strong>รวม</strong></small></td>
                            <td><small style="font-size: 12px;"><strong>ก.ปล.ภ</strong></small></td>
                            <td><small style="font-size: 12px;"><strong>ส.ปล.ภ</strong></small></td>
                            <td><small style="font-size: 12px;"><strong>จ.ส.ปล</strong></small></td>
                            <td><small style="font-size: 12px;"><strong>รวม</strong></small></td>
                            <td><small style="font-size: 12px;"><strong>คะแนน</strong></small></td>
                            <th>เกรด</th>
                            <td><small style="font-size: 12px;"><strong>ประเมิณ TC</strong></small></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $resData = studiedResultClass::getDataAll($_SESSION['uid'], $_POST['myT'], $_POST['yearclassID'], $_POST['yearClass']);
                        $myGPA = 0;
                        $credit = 0;

                        foreach ($resData as $item) :
                            $getCourse = courseActionClass::getCourseID($item['course_id']);
                            $credit += floatval($getCourse[0]['course_credit']);
                            $midterm_exam_scores = $item['midterm_exam_scores'];
                            $Final_exam_scores = $item['Final_exam_scores'];
                            $midterm_score = $item['midterm_score'];
                            $Final_score = $item['Final_score'];
                            $mentality_exam_score = $item['mentality_exam_score'];
                            $mentality_score = $item['mentality_score'];
                        ?>
                            <tr>
                                <td><?php echo $getCourse[0]['course_id'] ?></td>
                                <td><?php echo $getCourse[0]['course_name'] ?></td>
                                <td><?php echo $getCourse[0]['course_credit'] ?></td>
                                <td><?php echo $midterm_exam_scores ?></td>
                                <td><?php echo $Final_exam_scores ?></td>
                                <td><?php echo $mentality_exam_score ?></td>
                                <td><?php echo number_format(((floatval($midterm_exam_scores) + floatval($Final_exam_scores)) + floatval($mentality_exam_score)) / 2, 1) ?></td>
                                <td><?php echo $midterm_score ?></td>
                                <td><?php echo $Final_score ?></td>
                                <td><?php echo $mentality_score ?></td>
                                <td><?php echo number_format(((floatval($midterm_score) + floatval($Final_score)) + floatval($mentality_score)) / 2, 1) ?></td>
                                <td><?php echo $item['gpa'] ?></td>
                                <?php
                                $GPA = optionclass::calculateGPA($item['gpa']);

                                $myGPA += (floatval($GPA) * floatval($getCourse[0]['course_credit']));

                                ?>
                                <td>
                                    <?php echo $GPA ?>
                                </td>
                                <td class="text-center">
                                    <a href="?op=student-rate&cID=<?php echo $getCourse[0]['course_id'] ?>&Yc=<?php echo $_POST['yearClass']?>&yearclassID=<?php echo $_POST['yearclassID']?>">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


                <div class="col-12 text-center">
                    <strong>
                        <h3>
                            เกรดเฉลี่ย GPA ที่ได้
                            <?php if (count($resData) > 0) {
                                echo number_format(floatval($myGPA) / floatval($credit), 2);
                            } else {
                                echo 0;
                            }
                            ?>
                        </h3>
                    </strong>
                    <br>


                </div>

            </cdiv>
        </div>
    </div>

<?php endif; ?>