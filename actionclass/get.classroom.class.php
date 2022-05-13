<?php

class getClassroomClass extends db_connect {
    static public function get_Tc_Name($codeCourse, $class_year, $yearclassID){
        $sql = "SELECT t1.course_id, t1.class_year,  t2.Tc_id, t2.Tc_firstname, t2.Tc_lastname, t2.Tc_sex, t2.Tc_picture, t2.Tc_department, t2.Tc_position FROM addclass_data as t1 INNER JOIN teacher_table as t2 ON t1.teacherID= t2.Tc_id WHERE t1.course_id = ? AND t1.class_year = ? AND t1.yearclassID = ? LIMIT 1";
        $data = array($codeCourse, $class_year, $yearclassID);
        return self::getExecute($sql, $data);
    }
}