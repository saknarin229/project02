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
}