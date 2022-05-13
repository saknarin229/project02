
<?php
    if(isset($_POST['btnSave'])) teacherRateDataClass::action();
    $request = getClassroomClass::get_Tc_Name($_GET['cID'], $_GET['Yc'], $_GET['yearclassID']);
    $getData = teacherRateDataClass::getDataID($request[0]['Tc_id'] , $_SESSION['uid'] , $_GET['Yc']);
    $rate = 3;

    if(count($getData) > 0){
        $rate = $getData[0]['rate'];
    }
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-4  p-1 m-0">
            <div class="border p-3 shadow-sm">
                <h3><span> ประเมิณการสอนประจำปีการศึกษา <?php echo $request[0]['class_year']?></span></h3>
                <strong>ครู <?php echo $request[0]['Tc_firstname']." " . $request[0]['Tc_lastname']?></strong> <br>
                <span> รหัสวิชา <?php echo $request[0]['course_id']?></span> <br>
                
            </div>
        </div>
        <div class="col-8  p-1 m-0">
            <div class="border p-3 shadow-sm">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="Tc_id" value="<?php echo $request[0]['Tc_id']?>">
                    <input type="hidden" name="Std_ID" value="<?php echo $_SESSION['uid']?>">
                    <input type="hidden" name="year" value="<?php echo $request[0]['class_year']?>">
                    <div class="row">
                        <div class="col mb-3">
                            <input id="r1" <?php if(intval($rate) === 1) echo 'checked'?> type="radio" value="1" name="rDeO">
                            <label for="r1" class="form-label" style="cursor: pointer;">ดี</label>
                        </div>
                        <div class="col mb-3">
                            <input id="r2" <?php if(intval($rate) === 2) echo 'checked'?> type="radio" value="2" name="rDeO">
                            <label for="r2" class="form-label" style="cursor: pointer;">ดีมาก</label>
                        </div>
                        <div class="col mb-3">
                            <input id="r3" <?php if(intval($rate) === 3) echo 'checked'?> type="radio" value="3" name="rDeO">
                            <label for="r3" class="form-label" style="cursor: pointer;">ปานกลาง</label>
                        </div>
                        <div class="col mb-3">
                            <input id="r4" <?php if(intval($rate) === 4) echo 'checked'?> type="radio" value="4" name="rDeO">
                            <label for="r4" class="form-label" style="cursor: pointer;">เยี่ยม</label>
                        </div>
                        <div class="col mb-3">
                            <input id="r5" <?php if(intval($rate) === 5) echo 'checked'?> type="radio" value="5" name="rDeO">
                            <label for="r5" class="form-label" style="cursor: pointer;">ยอดเยี่ยม</label>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" name="btnSave" class="btn btn-primary w-100">ประเมิณ</button>
                </form>
            </div>
        </div>
    </div>
</div>