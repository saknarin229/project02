<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบทะเบียนเรียน</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" 
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" 
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>        


    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body style="background-image: url(Photo/110930809.jpg);">
<div class="container">
    <section class="col-12 position-relative">
        <img src="Photo/หน้าปก.png" class="w-100" alt="">
        <a href="?op=login" style="z-index: 1;" class="position-absolute top-0 end-0 mt-3 me-3 btn btn-sm btn-info">เข้าสู่ระบบ</a>
    </section>


    <section class="container shadow-sm bg-light">
        <div class="row">
            <div class="col p-2">
                <div class="list-group">
                    <a href="?op=home" class="<?php if($_GET['op'] === 'home') echo 'active'?> list-group-item list-group-item-action">เมนูหลัก</a>
                    <a href="?op=history" class="<?php if($_GET['op'] === 'history') echo 'active'?> list-group-item list-group-item-action">ประวัติโรงเรียน</a>
                    <a href="?op=philoso" class="<?php if($_GET['op'] === 'philoso') echo 'active'?> list-group-item list-group-item-action">ปรัชญาโรงเรียน</a>
                    <a href="?op=vision" class="<?php if($_GET['op'] === 'vision') echo 'active'?> list-group-item list-group-item-action">วิสัยทัศน์</a>
                    <a href="?op=slogan" class="<?php if($_GET['op'] === 'slogan') echo 'active'?> list-group-item list-group-item-action">คำขวัญของโรงเรียน</a>
                    <a href="?op=song" class="<?php if($_GET['op'] === 'song') echo 'active'?> list-group-item list-group-item-action">เพลงประจำโรงเรียน</a>
                </div>
            </div>
            <div class="col-9">
                
                <?php
                    if(isset($_SESSION['status'])){
                        if($_SESSION['status'] === "admin"){
                            include_once('layout/admin.nav.php');
                        }else if($_SESSION['status'] === "teacher"){
                            include_once('layout/teacher.nav.php');
                        }else if($_SESSION['status'] === "student"){
                            include_once('layout/student.nav.php');
                        }

                        echo "<hr>";
                    }


                    if(isset($_GET['op'])){
                        $file = str_replace('-','.',$_GET['op']);
                        if(file_exists("component/$file.php")){
                            include_once("component/$file.php");
                        }else{
                            include_once('component/404.php');
                        }
                    }else{
                        include_once('component/home.php');
                    }
                ?>

            </div>
        </div>


    </section>

    <section class="col-12 pt-3 bg-light">
        <img src="Photo/ข้างล้าง.png" class="w-100" alt="">
    </section>    

</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });    
</script>


</body>
</html>