<?php

class db_connect {
    static private function conn(){
        $servername = "localhost";
        $username = "root";
        $password = "123456789"; //ad123456789
        $db = 'schoolbang';

        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        return $conn;
    }

    //รูปแบบการเรียกใช้งาน!
    //sql * form where ?,?
    //array('data','data')
    static public function ExecuteData($sql, $data){
        $sth = self::conn()->prepare($sql);
        $sth->execute($data);
        return true;
    }

    static public function getExecute($sql, $data){
        $sth = self::conn()->prepare($sql);
        $sth->execute($data);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}

