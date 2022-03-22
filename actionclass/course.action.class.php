<?php


class courseActionClass extends db_connect {
    static public function getCourseAll(){
        $sql = "SELECT * FROM course_table WHERE course_status = ?";
        $data = array(0);
        return self::getExecute($sql, $data);
    }

    static public function getCourseID($id){
        $sql = "SELECT * FROM course_table WHERE course_id = ?";
        $data = array($id);
        return self::getExecute($sql, $data);
    }

    static public function getCourseName($id){
        $sql = "SELECT * FROM course_table WHERE course_id = ?";
        $data = array($id);
        $resData = self::getExecute($sql, $data);
        if(count($resData) > 0) return $resData[0]['course_name'];
        return null;
    }    
}