<?php


class studentActionClass extends db_connect {


    static public function actionData(){
        $id = null;
        if(isset($_GET['id'])) $id = $_GET['id'];
        $resCheck = self::getStudentID($id);
        return count($resCheck) > 0 ? self::updateData($id) : self::insertData();
    }

    static private function insertData(){
        $sql = "INSERT INTO student_table(Std_user, Std_password, Std_firstname, Std_lastname, Std_sex, Std_yearOfStudent) VALUES (?,?,?,?,?,?)";
        $data = array($_POST['Std_user'], $_POST['Std_user'], $_POST['Std_firstname'], $_POST['Std_lastname'], $_POST['Std_sex'], $_POST['Std_yearOfStudent']);
        self::ExecuteData($sql, $data);
        self::uploadImage($_FILES['myfile'], $_POST['Std_user']);
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');window.location.href='?op=admin-add-student'</script>";
    }

    static private function updateData($id){
        $sql = "UPDATE student_table SET Std_user=?,Std_password=?,Std_firstname=?,Std_lastname=?,Std_sex=?,Std_yearOfStudent=? WHERE Std_user=?";
        $data = array($_POST['Std_user'], $_POST['Std_user'], $_POST['Std_firstname'], $_POST['Std_lastname'], $_POST['Std_sex'], $_POST['Std_yearOfStudent'], $id);
        self::ExecuteData($sql, $data);
        self::uploadImage($_FILES['myfile'], $_POST['Std_user']);
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ');window.location.href='?op=admin-add-student'</script>";
    }

    static public function updateStatus($id){
        $sql = "UPDATE student_table SET Std_status=? WHERE Std_user=?";
        $data = array(2,$id);
        self::ExecuteData($sql, $data);
        echo "<script>window.location.href='?op=admin-add-student'</script>";
    }

    static public function getStudentAll(){
        $sql = "SELECT * FROM student_table WHERE Std_status = ?";
        $data = array(0);
        return self::getExecute($sql, $data);
    }

    static public function getStudentYearAll($year){
        $sql = "SELECT * FROM student_table WHERE Std_yearOfStudent LIKE '%$year%' AND Std_status = ?";
        $data = array(0);
        return self::getExecute($sql, $data);
    }    

    static public function getStudentID($id){
        $sql = "SELECT * FROM student_table WHERE Std_user = ?";
        $data = array($id);
        return self::getExecute($sql, $data);
    }

    static public function uploadImage($file, $code){
        if($file['name'] !== ""){
            
            $resData = self::getStudentID($code);
            if(count($resData) > 0){
                foreach($resData as $key=>$item){
                    if(file_exists($item['hospita_image'])){
                        unlink($item['hospita_image']);
                    }
                }
            }
            $pathFile = 'image/Std/';
            if(!is_dir($pathFile)) mkdir($pathFile, 0777);
            $type = explode('.',$file['name']);
            $type = end($type);
            $fileName = "$code.$type";
            move_uploaded_file($file['tmp_name'], $pathFile.$fileName);

            $sql = "UPDATE student_table SET Std_image=? WHERE Std_user=?";
            $data = array($pathFile.$fileName, $code);
            self::ExecuteData($sql, $data);

        }
    }


}