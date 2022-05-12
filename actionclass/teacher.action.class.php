<?php


class TeacherActionClass extends db_connect {
    static public function actionData(){
        $id = null;
        if(isset($_GET['id'])) $id = $_GET['id'];
        $resCheck = self::getDataID($id);

        return count($resCheck) > 0 ? self::updateData($id) : self::insertData();
    }

    static private function insertData(){
        $sql = "INSERT INTO teacher_table(Tc_user, Tc_password, Tc_firstname, Tc_lastname, Tc_sex, Tc_department, Tc_position) VALUES (?,?,?,?,?,?,?)";
        $data = array($_POST['Tc_user'], $_POST['Tc_user'], $_POST['Tc_firstname'], $_POST['Tc_lastname'], $_POST['Tc_sex'], $_POST['Tc_department'], $_POST['Tc_position']);
        self::ExecuteData($sql, $data);
        self::uploadImage($_FILES['Tc_picture'], $_POST['Tc_user']);
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');window.location.href='?op=admin-add-teacher'</script>";
    }

    static private function updateData($id){
        $sql = "UPDATE teacher_table SET Tc_user=?,Tc_password=?,Tc_firstname=?,Tc_lastname=?,Tc_sex=?,Tc_department=?,Tc_position=? WHERE Tc_user=?";
        $data = array($_POST['Tc_user'], $_POST['Tc_user'], $_POST['Tc_firstname'], $_POST['Tc_lastname'], $_POST['Tc_sex'], $_POST['Tc_department'], $_POST['Tc_position'], $id);
        self::ExecuteData($sql, $data);
        self::uploadImage($_FILES['Tc_picture'], $_POST['Tc_user']);
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ');window.location.href='?op=admin-add-teacher'</script>";
    }

    static public function getDataID($id){
        $sql = "SELECT * FROM teacher_table WHERE Tc_user=?";
        $data = array($id);
        return self::getExecute($sql, $data);
    }

    static public function getDataID2($id){
        $sql = "SELECT * FROM teacher_table WHERE Tc_id=?";
        $data = array($id);
        return self::getExecute($sql, $data);
    }    
  

    static public function getDataAll(){
        $sql = "SELECT * FROM teacher_table WHERE Tc_status = ?";
        $data = array(0);
        return self::getExecute($sql, $data);
    }

    static public function updataStatus($id){
        $sql = "UPDATE teacher_table SET Tc_status=? WHERE Tc_user=?";
        $data = array(0, $id);
        self::getExecute($sql, $data);
        echo "<script>window.location.href='?op=admin-add-teacher'</script>";
    }

    static public function DeleteSetUpdateStatus($id){
        $sql = "UPDATE teacher_table SET Tc_status=? WHERE Tc_user=?";
        $data = array(1, $id);
        self::ExecuteData($sql, $data);
        echo "<script>window.location.href='?op=admin-add-teacher'</script>";
    }    

    static public function uploadImage($file, $code){
        if($file['name'] !== ""){
            
            $resData = self::getDataID($code);
            if(count($resData) > 0){
                foreach($resData as $key=>$item){
                    if(file_exists($item['Tc_picture'])){
                        unlink($item['Tc_picture']);
                    }
                }
            }
            $pathFile = 'image/Tc/';
            if(!is_dir($pathFile)) mkdir($pathFile, 0777);
            $type = explode('.',$file['name']);
            $type = end($type);
            $fileName = "$code.$type";
            move_uploaded_file($file['tmp_name'], $pathFile.$fileName);

            $sql = "UPDATE teacher_table SET Tc_picture=? WHERE Tc_user=?";
            $data = array($pathFile.$fileName, $code);
            self::ExecuteData($sql, $data);

        }
    }

    static public function deleteImage($id){
        $resData = self::getDataID($id);
        if(count($resData) > 0){
            foreach($resData as $item){
                if(file_exists($item['Tc_picture'])) unlink($item['Tc_picture']);
                $sql = "UPDATE teacher_table SET Tc_picture=? WHERE Tc_user=?";
                $data = array('',$id);
                self::ExecuteData($sql, $data);
            }
        }
        echo "<script>window.location.href='?op={$_GET['op']}&id={$_GET['id']}'</script>";
    }

    static public function updatePassword($id, $password){
        $sql = "UPDATE teacher_table SET Tc_password = ? WHERE Tc_user = ?";
        $data = array($password, $id);
        self::ExecuteData($sql, $data);
        echo "<script>alert('แก้ไขรหัสผ่านเรียบร้อย');</script>";
    }
}