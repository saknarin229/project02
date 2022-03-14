<?php


class adminAddYearclassClass extends db_connect {
    static public function action(){
        $id = null;
        if(isset($_GET['id'])) $id = $_GET['id'];
        $checkData = self::getDataID($id);
        return count($checkData) > 0 ? self::updateData($id) : self::insertData();
    }

    static private function insertData(){
        $sql = "INSERT INTO yearclass(yearClassName) VALUES (?)";
        $data = array($_POST['yearClassName']);
        echo "<script>alert(`เพิ่มข้อมูลเรียบร้อย`)</script>";
        self::ExecuteData($sql, $data);
    }

    static private function updateData($id){
        $sql = "UPDATE yearclass SET yearClassName=? WHERE id=?";
        $data = array($_POST['yearClassName'], $id);
        echo "<script>alert(`แก้ไขข้อมูลเรียบร้อย`)</script>";
        self::ExecuteData($sql, $data);
    }

    static public function getDataID($id){
        $sql = "SELECT * FROM yearclass WHERE id = ?";
        $data = array($id);
        return self::getExecute($sql, $data);
    }

    static public function getDataAll(){
        $sql = "SELECT * FROM yearclass WHERE status = ?";
        $data = array(0);
        return self::getExecute($sql, $data);        
    }

    static public function updateStatus($id){
        $sql = "UPDATE yearclass SET status=? WHERE id=?";
        $data = array(1,$id);
        self::ExecuteData($sql, $data);
        echo "<script>window.location.href = `?op=admin-add-yearclass`</script>";

    }
}