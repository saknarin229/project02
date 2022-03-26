<?php

class studiedResultClass extends db_connect {
    static public function addResult(){
        
        $Y = $_POST['Y'];
        $course = $_POST['course'];
        $term = $_POST['myT'];
        $yearClass = $_POST['yearClass'];

        for($key = 0; $key < count($_POST['studentID']); $key++){

            $score = $_POST['score'][$key];
            $studentID = $_POST['studentID'][$key];

            $checkData = self::checkStudentID($studentID, $Y, $course, $term, $yearClass);
            if(count($checkData) > 0){
                self::updateData($studentID, $course, $score, $term, $Y, $yearClass);
            }else{
                self::insertData($studentID, $course, $score, $term, $Y, $yearClass);
            }
            
        }

        echo "<script> alert('save data success')</script>";

    }

    static private function insertData($sd_id, $course_id, $gpa, $gpa_term, $gpa_year, $yearClass){
        $sql = "INSERT INTO studied_result(sd_id, course_id, gpa, gpa_term, gpa_year, year) VALUES (?,?,?,?,?,?)";
        $data = array($sd_id, $course_id, $gpa, $gpa_term, $gpa_year, $yearClass);
        self::ExecuteData($sql, $data);
        return true;
    }

    static private function updateData($sd_id, $course_id, $gpa, $gpa_term, $gpa_year, $yearClass){
        $sql = "UPDATE studied_result SET course_id=?,gpa=?,gpa_term=?,gpa_year=?, year=? WHERE sd_id=?";
        $data = array($course_id, $gpa, $gpa_term, $gpa_year, $yearClass, $sd_id);
        self::ExecuteData($sql, $data);
        return true;
    }

    static private function checkStudentID($studentID, $Y, $course, $term, $yearClass){
        $sql = "SELECT * FROM studied_result WHERE sd_id = ? AND gpa_year = ? AND course_id = ? AND gpa_term = ? AND year = ?";
        $data = array($studentID, $Y, $course, $term, $yearClass);
        return self::getExecute($sql, $data);
    }

    static public function getDataAll($StdID, $gpaTerm, $gpaYear, $year){
        $sql = "SELECT * FROM studied_result WHERE sd_id = ? AND gpa_term = ? AND gpa_year = ? AND year = ?";
        $data = array($StdID, $gpaTerm, $gpaYear, $year);
        $resData = self::getExecute($sql, $data);
        return $resData;
    }
}