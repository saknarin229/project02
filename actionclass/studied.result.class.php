<?php

class studiedResultClass extends db_connect {
    static public function addResult(){
        
        $Y = $_POST['Y'];
        $course = $_POST['course'];        

        for($key = 0; $key < count($_POST['studentID']); $key){
            
            $score = $_POST['score'][$key];
            $studentID = $_POST['studentID'][$key];

            $checkData = self::checkStudentID($studentID, $Y, $course);
            if(count($checkData) > 0){
                self::updateData();
            }else{
                self::insertData();
            }
            
            // print_r("$item {$_POST['score'][$key]} <br>");
        }

        echo "save data success";

    }

    static private function insertData(){
        $sql = "";
        $data = array();
        self::ExecuteData($sql, $data);
        return true;
    }

    static private function updateData(){
        $sql = "";
        $data = array();
        self::ExecuteData($sql, $data);
        return true;
    }

    static private function checkStudentID($studentID, $Y, $course){
        $sql = "";
        $data = array();
        return  self::getExecute($sql, $data);
    }
}