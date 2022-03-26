<?php

if (isset($_POST['btnSave'])) adminAddclassActionClass::actionData();


$class_term = null;
$class_year = null;
$class_day = null;
$class_time = null;
$teacherID = null;
$departmentID = null;
$course_id = null;


if(isset($_GET['time'])){
    $getDataEdit = adminAddclassActionClass::getDataID($_GET['time'], $_GET['year'], $_GET['day'], $_GET['Y']);
    if(count($getDataEdit) > 0){
        foreach($getDataEdit as $key=>$item){
            $class_term = $item['class_term'];
            $class_year = $item['class_year'];
            $class_day = $item['class_day'];
            $class_time = $item['class_time'];
            $teacherID = $item['teacherID'];
            $departmentID = $item['departmentID'];
            $course_id = $item['course_id'];
        }
    }
}



$department = departmentActionClass::getDeparmentAll();
$Teacher = TeacherActionClass::getDataAll();
$yearclass = adminAddYearclassClass::getDataAll();
$course = courseActionClass::getCourseAll();

?>

<style>
    .td-h:hover {
        background-color: #CCCCCC;
        cursor: pointer;
    }
</style>

<section class="container">

    <?php
    $day = array(
        'จ.' => 'จันทร์',
        'อ.' => 'อังคาร',
        'พ.' => 'พุธ',
        'พฤ.' => 'พฤหัสบดี',
        'ศ.' => 'ศุกร์',
        'ส.' => 'เสาร์',
        'อา' => 'อาทิตย์'
    );

    $time = array(
        1 => '08.30-09.20',
        2 => '09.20-10.10',
        3 => '10.20-11.10',
        5 => '12.00-12.50',
        6 => '12.50-13.40',
        7 => '13.40-14.40	',
        8 => '14.40-15.30',
        9 => '15.30-16.20',
        10 => '16.20-17.10'
    );

    $Y = null;
    if (isset($_GET['Y'])) $Y = $_GET['Y'];
    ?>

    <div class="col-12">

        <form action="" method="GET" enctype="multipart/form-data">
            <div class="d-flex justify-content-center">
                <div class="col-12 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">ปีการศึกษา</label>
                        <input type="text" class="form-select form-select-sm" disabled id="myYear" value="<?php echo (intval(date('Y'))) + 543?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ชั้นปี</label>
                        <select name="yearclassID" class="form-select form-select-sm" id="" onchange="getYear(this)">
                            <option value="" selected disabled>---เลือกชั้นปี---</option>
                            <?php foreach ($yearclass as $item) : ?>
                                <option <?php if ($Y === $item['id']) echo 'selected' ?> value="<?php echo $item['id'] ?>"><?php echo $item['yearClassName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <?php if (isset($_GET['day'])) : ?>
            <hr>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-center">
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">ภาคเรียนที่</label>
                            <select name="class_term" class="form-select form-select-sm" id="">
                                <option selected disabled value="">---เลือกภาคเรียนที่---</option>
                                <option <?php if(intval($class_term) === 1) echo 'selected'; ?> value="1">ภาคเรียนที่ 1</option>
                                <option <?php if(intval($class_term) === 2) echo 'selected'; ?> value="2">ภาคเรียนที่ 2</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ปีการศึกษา</label>
                            <input type="text" disabled class="form-control form-control-sm" value="<?php echo $_GET['year'] ?>">
                            <input type="hidden" name="class_year" value="<?php echo $_GET['year'] ?>">
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">วัน</label>
                                <input type="text" name="class_day" disabled class="form-control form-control-sm" value="<?php echo $day[$_GET['day']] ?>">
                            </div>
                            <div class="col">
                                <label class="form-label">เวลา</label>
                                <input type="text" name="class_time" disabled class="form-control form-control-sm" value="<?php echo $time[$_GET['time']] ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ครูผู้สอน</label>
                            <select name="teacherID" class="form-select form-select-sm" id="">
                                <option selected disabled value="">---เลือกครูผู้สอน---</option>
                                <?php foreach ($Teacher as $item) : ?>
                                    <option <?php if(intval($teacherID) === intval($item['Tc_id'])) echo 'selected';?> value="<?php echo $item['Tc_id'] ?>"><?php echo "{$item['Tc_firstname']} {$item['Tc_lastname']}" ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ประจำวิชา</label>
                            <select name="departmentID" class="form-select form-select-sm" id="">
                                <option selected disabled value="">---เลือกประจำวิชา---</option>
                                <?php foreach ($department as $item) : ?>
                                    <option <?php if(intval($departmentID) === intval($item['id'])) echo 'selected';?> value="<?php echo $item['id'] ?>"><?php echo $item['subjectName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">สอนวิชา</label>
                            <select name="course_id" class="form-select form-select-sm" id="">
                                <option selected disabled value="">---เลือกสอนวิชา---</option>
                                <?php foreach ($course as $item) : ?>
                                    <option <?php if($course_id === $item['course_id']) echo 'selected';?> value="<?php echo $item['course_id'] ?>"><?php echo "{$item['course_id']} : {$item['course_name']}" ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="btnSave" class="btn btn-sm btn-primary w-100">บันทึกตาราง</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <?php if (isset($_GET['Y'])) : ?>
        <div class="col-12 mt-3">
            <table class="table table-bordered">
                <tr style="background-color: #CCCCCC;">
                    <td><strong style="font-size: 12px;">ชั่งโมง</strong></td>
                    <td><strong style="font-size: 12px;">1</strong></td>
                    <td><strong style="font-size: 12px;">2</strong></td>
                    <td><strong style="font-size: 12px;">3</strong></td>
                    <td><strong style="font-size: 12px;">4</strong></td>
                    <td><strong style="font-size: 12px;">5</strong></td>
                    <td><strong style="font-size: 12px;">6</strong></td>
                    <td><strong style="font-size: 12px;">7</strong></td>
                    <td><strong style="font-size: 12px;">8</strong></td>
                    <td><strong style="font-size: 12px;">9</strong></td>
                    <td><strong style="font-size: 12px;">10</strong></td>
                </tr>
                <tr style="background-color: #E5E5E5;">
                    <td><strong style="font-size: 12px;">เวลา</strong></td>
                    <td><strong style="font-size: 12px;">08.30-09.20</strong></td>
                    <td><strong style="font-size: 12px;">09.20-10.10</strong></td>
                    <td><strong style="font-size: 12px;">10.20-11.10</strong></td>
                    <td><strong style="font-size: 12px;">11.10-12.00</strong></td>
                    <td><strong style="font-size: 12px;">12.00-12.50</strong></td>
                    <td><strong style="font-size: 12px;">12.50-13.40</strong></td>
                    <td><strong style="font-size: 12px;">13.40-14.40</strong></td>
                    <td><strong style="font-size: 12px;">14.40-15.30</strong></td>
                    <td><strong style="font-size: 12px;">15.30-16.20</strong></td>
                    <td><strong style="font-size: 12px;">16.20-17.10</strong></td>
                </tr>
                <?php $dayName = array('จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.', 'อา'); ?>
                <?php foreach ($dayName as $item) : ?>
                    <tr>
                        <td><?php echo $item ?></td>

                        <td onclick="getRow(this)" class="td-h" data-time="1" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(1, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>
                        <td onclick="getRow(this)" class="td-h" data-time="2" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(2, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>
                        <td onclick="getRow(this)" class="td-h" data-time="3" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(3, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>

                        <td class="text-center"><strong style="font-size: 12px;">พักเที่ยง</strong></td>

                        <td onclick="getRow(this)" class="td-h" data-time="5" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(5, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>
                        <td onclick="getRow(this)" class="td-h" data-time="6" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(6, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>
                        <td onclick="getRow(this)" class="td-h" data-time="7" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(7, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>
                        <td onclick="getRow(this)" class="td-h" data-time="8" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(8, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>
                        <td onclick="getRow(this)" class="td-h" data-time="9" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(9, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>
                        <td onclick="getRow(this)" class="td-h" data-time="10" data-day="<?php echo $item ?>" data-year="<?php echo $_GET['year']?>">
                            <?php optionclass::getMyclass(10, $_GET['year'], $item, $_GET['Y']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</section>

<script>
    function getRow(x) {
        const date = x.getAttribute('data-day');
        const year = x.getAttribute('data-year');
        const time = x.getAttribute('data-time');
        const url = new URL(window.location.href);
        window.location.href = `?op=${url.searchParams.get('op')}&Y=${url.searchParams.get('Y')}&day=${date}&time=${time}&year=${year}`;
    }

    function getYear(Y) {
        const url = new URL(window.location.href);
        const myYear = document.getElementById('myYear').value;
        window.location.href = `?op=${url.searchParams.get('op')}&Y=${Y.value}&year=${myYear}`;
    }
</script>

<!-- https://kalasinpit.ac.th/wp-content/uploads/2019/12/2-13.jpg -->