
<?php include_once('layout/teacher.nav.php');?>

<hr>

<section class="container">

    <div class="col-12 mt-3">
        <form action="" method="GET" enctype="multipart/form-data">
            <div class="d-flex justify-content-center">
                <div class="col-12 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">ปีการศึกษา</label>
                        <input type="text" class="form-control form-control-sm" id="myYear" value="<?php echo $_GET['Y']?>">
                    </div>
                    <div class="mb-3">
                        <input type="radio" name="mtT" id="myT1" <?php if(intval($_GET['t']) === 1) echo 'checked'?> value="1">
                        <label for="myT1">เทรม 1</label>
                        <input type="radio" name="mtT" id="myT2" <?php if(intval($_GET['t']) === 2) echo 'checked'?> value="2">
                        <label for="myT2">เทรม 2</label>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="w-100 btn btn-sm btn-primary" onclick="getYear()">ค้นหา</button>
                    </div>
                </div>
            </div>
        </form>        
    </div>
    <br><br>
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
                        <?php optionclass::getMyclassID3(1, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID3(2, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID3(3, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>

                    <td class="text-center"><strong style="font-size: 12px;">พักเที่ยง</strong></td>

                    <td class="td-h">
                        <?php optionclass::getMyclassID3(5, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID3(6, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID3(7, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID3(8, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID3(9, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>
                    <td class="td-h">
                        <?php optionclass::getMyclassID3(10, $_GET['Y'], $item, $_SESSION['uid'], $_GET['t']); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
</section>

<script>
    function getYear(){
        const url = new URL(window.location.href);
        const myYear = document.getElementById('myYear').value;
        const mtT =  document.querySelector('input[name="mtT"]:checked').value;
        window.location.href = `?op=${url.searchParams.get('op')}&Y=${myYear}&t=${mtT}`;
    }
</script>