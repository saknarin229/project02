<?php


class adminCourseActionClass extends db_connect {
    static public function actionData(){
        $id = null;
        if(isset($_GET['id'])) $id = $_GET['id'];
        $resCheck = self::getDataID($id);
        return count($resCheck) > 0 ? self::updateData($id) : self::insertData();
    }

    static private function insertData(){
        $sql = "INSERT INTO course_table(course_id, course_name, course_credit) VALUES (?,?,?)";
        $data = array($_POST['course_id'],$_POST['course_name'],$_POST['course_credit']);
        self::ExecuteData($sql, $data);
        echo "<script>alert('เพิ่มข้อมูลเรียบร้อย')</script>";
    }

    static private function updateData($id){
        $sql = "UPDATE course_table SET course_id=?,course_name=?,course_credit=? WHERE course_id=?";
        $data = array($_POST['course_id'],$_POST['course_name'],$_POST['course_credit'],$id);
        self::ExecuteData($sql, $data);
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อย'); window.location.href = `?op=admin-add-course&id={$_POST['course_id']}`</script>";
    }

    static public function getDataAll(){
        $sql = "SELECT * FROM course_table WHERE course_status = ?";
        $data = array(0);
        return self::getExecute($sql, $data);
    }

    static public function getDataID($id){
        $sql = "SELECT * FROM course_table WHERE course_id = ?";
        $data = array($id);
        return self::getExecute($sql, $data);
    }

    static public function updateStatus($id){
        $sql = "UPDATE course_table SET course_status=? WHERE course_id=?";
        $data = array(1, $id);
        self::ExecuteData($sql, $data);
        echo "<script>window.location.href = `?op=admin-add-course`</script>";

    }
}