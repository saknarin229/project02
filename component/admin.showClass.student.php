<?php optionclass::checkAdminStatus()?>
<?php

$yearclass = adminAddYearclassClass::getDataAll();
$getStudentData = studentActionClass::getStudentID($_GET['StdID']);

$Y = null;
if (isset($_GET['Y'])) $Y = $_GET['Y'];
?>



<section class="container">

    <div class="col-12 mt-3">
        <form action="" method="GET" enctype="multipart/form-data">
            <div class="d-flex justify-content-center">
                <div class="col-12 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">ปีการศึกษา</label>
                        <input type="text" class="form-control form-control-sm" id="myYear" value="<?php echo $_GET['year'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ชั้นปี</label>
                        <select name="yearclassID" class="form-select form-select-sm" id="yearclassID">
                            <option value="" selected disabled>---เลือกชั้นปี---</option>
                            <?php foreach ($yearclass as $item) : ?>
                                <option <?php if ($Y === $item['id']) echo 'selected' ?> value="<?php echo $item['id'] ?>"><?php echo $item['yearClassName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="w-100 btn btn-sm btn-primary" onclick="getYear()">ค้นหา</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-12 mt-3">
        <?php if ($getStudentData[0]['Std_image'] === "" || $getStudentData[0]['Std_image'] === null) : ?>
            <img src="https://cdn.pixabay.com/photo/2020/07/14/13/07/icon-5404125_1280.png" style="max-width: 10rem;" alt="">
        <?php else : ?>
            <img src="<?php echo $getStudentData[0]['Std_image'] ?>" style="max-width: 10rem;" alt="">
        <?php endif; ?>

        <h3 class="mt-3">เกี่ยวกับนักเรียน</h3>

        <span>รหัสประจำตัว : <?php echo $getStudentData[0]['Std_user'] ?></span> <br>
        <span>ชื่อ : <?php echo "{$getStudentData[0]['Std_firstname']} {$getStudentData[0]['Std_lastname']}" ?></span> <br>
        <span>เพศ : <?php echo $getStudentData[0]['Std_sex'] ?></span> <br>
        <span>ชั้น : <?php $YearClass = adminAddYearclassClass::getDataID($getStudentData[0]['yearClass']);
                        echo $YearClass[0]['yearClassName'] ?></span> <br>



    </div>

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

                    <td class="td-h">
                        <?php optionclass::getMyclassID2(1, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID2(2, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID2(3, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>

                    <td class="text-center"><strong style="font-size: 12px;">พักเที่ยง</strong></td>

                    <td class="td-h">
                        <?php optionclass::getMyclassID2(5, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID2(6, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID2(7, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID2(8, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID2(9, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID2(10, $_GET['year'], $item, $_GET['Y']); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>



<script>
    function getYear() {

        const url = new URL(window.location.href);
        const myYear = document.getElementById('myYear').value;
        const yearclassID = document.getElementById('yearclassID').value;
        window.location.href = `?op=${url.searchParams.get('op')}&StdID=${url.searchParams.get('StdID')}&Y=${yearclassID}&year=${myYear}`;
    }
</script>