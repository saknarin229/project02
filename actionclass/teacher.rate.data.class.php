<?php


class teacherRateDataClass extends db_connect {
    static public function action(){
        $Tc_id = $_POST['Tc_id'];
        $Std_ID = $_POST['Std_ID'];
        $year = $_POST['year'];
        $rDeO = $_POST['rDeO'];
        $checkData = self::getDataID($Tc_id ,$Std_ID ,$year);
        count($checkData) > 0 ? self::updateData($Tc_id ,$Std_ID ,$year, $rDeO) : self::insetData($Tc_id ,$Std_ID ,$year, $rDeO);
    }

    static private function insetData($Tc_id ,$Std_ID ,$year, $rDeO){
        $sql = "INSERT INTO teacher_rate_data(std_id, tc_id, rate, year) VALUES (?,?,?,?)";
        $data = array($Std_ID , $Tc_id, $rDeO, $year);
        self::ExecuteData($sql, $data);
        echo "<script>alert('บันทึกแบบประเมิณเรียบร้อย!')</script>";
    }

    static private function updateData($Tc_id ,$Std_ID ,$year, $rDeO){
        $sql = "UPDATE teacher_rate_data SET rate=? WHERE std_id=? AND tc_id=? AND  year=?";
        $data = array($rDeO, $Std_ID, $Tc_id , $year);
        self::ExecuteData($sql, $data);
        echo "<script>alert('บันทึกแบบประเมิณเรียบร้อย!')</script>";
    }

    static public function getDataID($Tc_id ,$Std_ID ,$year){
        $sql = "SELECT * FROM teacher_rate_data WHERE std_id = ? AND tc_id = ? AND  year = ?";
        $data = array($Std_ID ,$Tc_id ,$year);
        return self::getExecute($sql, $data);
    }
}