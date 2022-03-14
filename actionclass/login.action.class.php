<?php



class loginActionClass extends db_connect {
    static public function login(){
        if($_POST['username'] === "" || $_POST['password'] === ""){
            echo "<script>alert('username or password  is not defined !')</script>";
        }
        self::checkLogin();
    }

    static private function checkLogin(){

        if(self::adminLogin() === true){
            echo "<script>window.location.href = `?op=admin-dashboard`</script>";
        }else if(self::teacherLogin() === true){
            echo "<script>window.location.href = `?op=teacher-dashboard`</script>";
        }else if(self::studentLogin() === true){
            echo "<script>window.location.href = `?op=student-dashboard`</script>";
        }else{
            echo "<script>alert('username or password  is not incorrect !')</script>";
        }
        
    }

    static private function adminLogin(){
        $sql = "SELECT * FROM administrator_table WHERE admin_user =  ? AND admin_password = ?"; // admin
        $data = array($_POST['username'], $_POST['password']);
        $resData = self::getExecute($sql, $data);
        if(count($resData) > 0){
            foreach($resData as $item){
                $_SESSION['status'] = 'admin';
                $_SESSION['uid'] = $item['id'];
                return true;
            }
        }

        return false;
    }

    static private function teacherLogin(){
        $sql = "SELECT * FROM teacher_table WHERE Tc_user = ? AND Tc_password = ? AND Tc_status = ?"; // teacher
        $data = array($_POST['username'], $_POST['password'], 0);
        $resData = self::getExecute($sql, $data);
        if(count($resData) > 0){
            foreach($resData as $item){
                $_SESSION['status'] = 'teacher';
                $_SESSION['uid'] = $item['id'];
                return true;
            }
        }
        return false;
    }

    static private function studentLogin(){
        $sql = "SELECT * FROM `student_table` WHERE Std_user = ? AND Std_password = ? AND Std_status = ?"; // student
        $data = array($_POST['username'], $_POST['password'], 0);
        $resData = self::getExecute($sql, $data);
        if(count($resData) > 0){
            foreach($resData as $item){
                $_SESSION['status'] = 'student';
                $_SESSION['uid'] = $item['Tc_id'];
                return true;
            }
        }

        return false;
    }    

    

}