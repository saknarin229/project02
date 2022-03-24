<?php

class optionclass extends db_connect{
    static public function checkAdminStatus (){
        $ch = self::checkSESSION('admin');
        if($ch === false) echo "<script>window.location.href = `?op=login`</script>";

    }

    static public function checkTeacherStatus (){
        $ch = self::checkSESSION('teacher');
        if($ch === false) echo "<script>window.location.href = `?op=login`</script>";
    }    

    static public function checkStudantStatus (){
        $ch = self::checkSESSION('student');
        if($ch === false) echo "<script>window.location.href = `?op=login`</script>";
    }        

    static private function checkSESSION($status){
        if(isset($_SESSION['status'])){
            if($_SESSION['status'] === $status) return true;
            return false;
        }else{
            echo "<script>window.location.href = `?op=login`</script>";
        }
    }

    static public function getData($table, $fill, $FWhere, $value){
        $sql = "SELECT $fill FROM $table WHERE $FWhere = ?";
        $data = array($value);
        $resData = self::getExecute($sql,$data);
        if(count($resData) > 0){
            foreach($resData as $item){
                return $item[$fill];
            }
        }

        return "-";
    }

    static public function DateThai($strDate)
    {
        $date = date_create($strDate);

        $strYear = intval(date_format($date, "Y")) + 543;
        $strMonth = intval(date_format($date, "m"));
        $strDay = intval(date_format($date, "d"));

        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[intval($strMonth)];
        return "$strDay $strMonthThai $strYear";
    }

    static public function getDataClass($time, $year, $day, $Y){
        $sql = "SELECT * FROM addclass_data WHERE class_time = ? AND class_year = ? AND class_day = ? AND class_status = ? AND yearclassID = ?";
        $data = array($time, $year, $day, 0, $Y);
        $resData = self::getExecute($sql, $data);
        return $resData;
    }

    static public function getMyclass($time, $year, $day, $Y){
        $resData = self::getDataClass($time, $year, $day, $Y);
        if (count($resData) > 0) {
            $resDataCourse = courseActionClass::getCourseID($resData[0]['course_id']);
            $resDataTeacher = TeacherActionClass::getDataID2($resData[0]['teacherID']);
            echo "{$resData[0]['course_id']} <br> <small style='font-size:12px'> {$resDataCourse[0]['course_name']}</small> <br> <small style='font-size:12px'>{$resDataTeacher[0]['Tc_firstname']} {$resDataTeacher[0]['Tc_lastname']}</small>";
        } else {
            echo "<span style='color:#E5E5E5'>ว่าง</span>";
        }
    }    

    static public function getMyclassID($time, $year, $day, $Y, $TcId){ // ครู

        $resTeacher = TeacherActionClass::getDataID($TcId);

        $sql = "SELECT * FROM addclass_data WHERE class_time = ? AND class_year = ? AND class_day = ? AND class_status = ? AND yearclassID = ? AND teacherID = ?";
        $data = array($time, $year, $day, 0, $Y, $resTeacher[0]['Tc_id']);
        $resData = self::getExecute($sql, $data);
        if (count($resData) > 0) {
            $resDataCourse = courseActionClass::getCourseID($resData[0]['course_id']);
            $resDataYearClass = adminAddYearclassClass::getDataID($resData[0]['yearclassID']);
            echo "{$resData[0]['course_id']} <br> <small style='font-size:12px'> {$resDataCourse[0]['course_name']}</small> <br> <small style='font-size:12px'>{$resDataYearClass[0]['yearClassName']}</small>";
        } else {
            echo "<span style='color:#E5E5E5'>ว่าง</span>";
        }
    }

    static public function getMyclassID3($time, $year, $day, $TcId){ // ครู 2

        $resTeacher = TeacherActionClass::getDataID($TcId);

        $sql = "SELECT * FROM addclass_data WHERE class_time = ? AND class_year = ? AND class_day = ? AND class_status = ? AND teacherID = ?";
        $data = array($time, $year, $day, 0, $resTeacher[0]['Tc_id']);
        $resData = self::getExecute($sql, $data);
        if (count($resData) > 0) {
            $resDataCourse = courseActionClass::getCourseID($resData[0]['course_id']);
            $resDataYearClass = adminAddYearclassClass::getDataID($resData[0]['yearclassID']);
            echo "{$resData[0]['course_id']} <br> <small style='font-size:12px'> {$resDataCourse[0]['course_name']}</small> <br> <small style='font-size:12px'>{$resDataYearClass[0]['yearClassName']}</small>";
        } else {
            echo "<span style='color:#E5E5E5'>ว่าง</span>";
        }
    }    
    
    static public function getMyclassID2($time, $year, $day, $Y){ //นักเรียน

        $sql = "SELECT * FROM addclass_data WHERE class_time = ? AND class_year = ? AND class_day = ? AND class_status = ? AND yearclassID = ?";
        $data = array($time, $year, $day, 0, $Y);
        $resData = self::getExecute($sql, $data);
        if (count($resData) > 0) {
            $resDataCourse = courseActionClass::getCourseID($resData[0]['course_id']);
            echo "{$resData[0]['course_id']} <br> <small style='font-size:12px'> {$resDataCourse[0]['course_name']}</small>";
        } else {
            echo "<span style='color:#E5E5E5'>ว่าง</span>";
        }
    }       

}