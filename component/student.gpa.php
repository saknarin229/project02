<?php optionclass::checkStudantStatus()?>
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
                    <input type="text" class="form-control form-control-sm" name="yearClass" id=""
                        value="<?php echo $getyearClass ?>">
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
                    <input type="radio" <?php if (intval($myT) === 1) echo 'checked' ?> name="myT" id="myT1" checked
                        value="1">
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
                        <th>คะแนน</th>
                        <th>เกรด</th>
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
                        ?>
                    <tr>
                        <td><?php echo $getCourse[0]['course_id'] ?></td>
                        <td><?php echo $getCourse[0]['course_name'] ?></td>
                        <td><?php echo $getCourse[0]['course_credit'] ?></td>
                        <td><?php echo $item['gpa'] ?></td>
                        <?php
                            $GPA = optionclass::calculateGPA($item['gpa']);

                            $myGPA += (floatval($GPA) * floatval($getCourse[0]['course_credit']));
                            
                        ?>
                        <td>
                            <?php echo $GPA ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <div class="col-12 text-center">
                <strong>
                    <h3>
                        เกรดเฉลี่ย GPA ที่ได้ 
                        <?php if(count($resData) > 0){
                            echo number_format(floatval($myGPA) / floatval($credit), 2);
                        } else{
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