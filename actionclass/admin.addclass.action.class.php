<?php


class adminAddclassActionClass extends db_connect {
    static public function actionData(){
        
        $class_time = $_GET['time'];
        $class_day = $_GET['day'];
        $class_year = $_POST['class_year'];
        $class_term = $_POST['class_term'];
        $departmentID = $_POST['departmentID'];
        $teacherID = $_POST['teacherID'];
        $day = $_GET['day'];
        $time = $_GET['time'];
        $yearclassID = $_GET['Y'];
        $course_id = $_POST['course_id'];
        
        $checkData = self::getDataID($time, $class_year, $day, $yearclassID);
        return count($checkData) > 0 ? self::updateData($class_time ,$class_day, $class_year, $class_term, $departmentID, $teacherID, $day, $time, $yearclassID, $course_id) : self::insertData($class_time ,$class_day, $class_year, $class_term, $departmentID, $teacherID, $day, $time, $yearclassID, $course_id);
    }

    static private function insertData($class_time ,$class_day, $class_year, $class_term, $departmentID, $teacherID, $day, $time, $yearclassID, $course_id){
        $sql = "INSERT INTO addclass_data (teacherID, departmentID, class_term, class_year, class_day, class_time, yearclassID, course_id) VALUES (?,?,?,?,?,?,?,?)";
        $data = array("$teacherID", "$departmentID", "$class_term", "$class_year", "$class_day", "$class_time", "$yearclassID", "$course_id");
        self::ExecuteData($sql, $data);
        echo "<script>alert('เพิ่มข้อมูลเรียบร้อย'); window.location.href=window.location.href</script>";
    }

    static private function updateData($class_time ,$class_day, $class_year, $class_term, $departmentID, $teacherID, $day, $time, $yearclassID, $course_id){
        $sql = "UPDATE addclass_data SET teacherID=?,departmentID=?,class_term=?,class_year=?,class_day=?,class_time=?, yearclassID=?, course_id=? WHERE class_time = ? AND class_year = ? AND class_day = ?";
        $data = array($teacherID, $departmentID, $class_term, $class_year, $class_day,$class_time, $yearclassID, $course_id, $time, $class_year, $day);
        self::ExecuteData($sql, $data);
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อย'); window.location.href=window.location.href</script>";
    }

    static public function getDataID($time, $class_year, $day, $yearclassID){
        $sql = "SELECT * FROM addclass_data WHERE class_time = ? AND class_year = ? AND class_day = ? AND class_status = ? AND yearclassID = ?";
        $data = array($time, $class_year, $day, 0, $yearclassID);
        $resData = self::getExecute($sql, $data);
        return $resData;
    }

    // static public function getDataAll(){
    //     $sql = "";
    //     $data = array();
    //     $resData = self::getExecute($sql, $data);
    //     return $resData;
    // }
}