<?php


class gpaGetClass extends db_connect {
    static public function getData($StdID, $courseID, $term, $Y, $year){
        $sql = "SELECT * FROM `studied_result` WHERE `sd_id` = ? AND course_id = ? AND `gpa_term` = ? AND `gpa_year` = ? AND `year` = ?";
        $data = array($StdID, $courseID, $term, $Y, $year);
        $resData = self::getExecute($sql, $data);
        if(count($resData) > 0) return $resData[0]['gpa'];
        return null;
    }

    static public function getDataNew($StdID, $courseID, $term, $Y, $year){
        $sql = "SELECT * FROM `studied_result` WHERE `sd_id` = ? AND course_id = ? AND `gpa_term` = ? AND `gpa_year` = ? AND `year` = ?";
        $data = array($StdID, $courseID, $term, $Y, $year);
        return self::getExecute($sql, $data);
        
    }    
}