<?php

class studiedResultClass extends db_connect {
    static public function addResult(){
        
        $Y = $_POST['Y'];
        $course = $_POST['course'];
        $term = $_POST['myT'];
        $yearClass = $_POST['yearClass'];

        // $score = $_POST['score'];
        $studentID = $_GET['stdID'];


        $midtermExamScores = floatval($_POST['midterm-exam-scores']);
        $FinalExamScores = floatval($_POST['Final-exam-scores']);
        $midtermScore = floatval($_POST['midterm-score']);
        $FinalScore = floatval($_POST['Final-score']);

        $mentalityExamScore = floatval($_POST['mentality-exam-score']);
        $mentalityScore = floatval($_POST['mentality-score']);     

        // $getCourse = courseActionClass::getCourseID($course);
        // $credit = floatval($getCourse[0]['course_credit']) * 2; //2 = กลางภาค ปลายภาค
        $xx = ((floatval($midtermExamScores) + floatval($FinalExamScores)) + floatval($mentalityExamScore));
        $yy = ((floatval($midtermScore) + floatval($FinalScore))  + floatval($mentalityScore)); 
        $x = $xx > 100 ? 100 : $xx;
        $y = $yy > 100 ? 100 : $yy;

        $Exam = ($x / 2);
        $endOfTerm =  ($y / 2);
        $score = (floatval($Exam) + floatval($endOfTerm));

        // print_r($score);
        // print_r("$x $y ");
        // print_r("$Exam $endOfTerm");

        $checkData = self::checkStudentID($studentID, $Y, $course, $term, $yearClass);

        if(count($checkData) > 0){
            self::updateData($studentID, $course, $score, $term, $Y, $yearClass, $midtermExamScores, $FinalExamScores, $midtermScore, $FinalScore, $mentalityExamScore, $mentalityScore);
        }else{
            self::insertData($studentID, $course, $score, $term, $Y, $yearClass, $midtermExamScores, $FinalExamScores, $midtermScore, $FinalScore, $mentalityExamScore, $mentalityScore);
        }
            
        

        echo "<script> alert('save data success')</script>";

    }

    static private function insertData($sd_id, $course_id, $gpa, $gpa_term, $gpa_year, $yearClass, $midtermExamScores, $FinalExamScores, $midtermScore, $FinalScore, $mentalityExamScore, $mentalityScore){
        $sql = "INSERT INTO studied_result(sd_id, course_id, gpa, gpa_term, gpa_year, year, midterm_exam_scores, Final_exam_scores, 	midterm_score, Final_score, mentality_exam_score, mentality_score) VALUES (?,?,?,?,?,?, ?,?,?,?,?,?)";
        $data = array($sd_id, $course_id, $gpa, $gpa_term, $gpa_year, $yearClass, $midtermExamScores, $FinalExamScores, $midtermScore, $FinalScore, $mentalityExamScore, $mentalityScore);
        
        self::ExecuteData($sql, $data);
        return true;
    }

    static private function updateData($sd_id, $course_id, $gpa, $gpa_term, $gpa_year, $yearClass, $midtermExamScores, $FinalExamScores, $midtermScore, $FinalScore, $mentalityExamScore, $mentalityScore){
        $sql = "UPDATE studied_result SET course_id=?,gpa=?,gpa_term=?,gpa_year=?, year=?, midterm_exam_scores = ?, Final_exam_scores = ?, 	midterm_score = ?, Final_score = ?, mentality_exam_score=?, mentality_score=? WHERE sd_id=?";
        $data = array($course_id, $gpa, $gpa_term, $gpa_year, $yearClass, $midtermExamScores, $FinalExamScores, $midtermScore, $FinalScore, $mentalityExamScore, $mentalityScore, $sd_id);
        self::ExecuteData($sql, $data);
        return true;
    }

    static public function checkStudentID($studentID, $Y, $course, $term, $yearClass){
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