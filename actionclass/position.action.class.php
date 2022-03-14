<?php 


class positionActionClass extends db_connect {
    static public function getPositionAll(){
        $sql = "SELECT * FROM position_data WHERE status = ?";
        $data = array(0);
        return self::getExecute($sql, $data);
    }

    static public function getPositionID($id){
        $sql = "SELECT * FROM position_data WHERE id = ?";
        $data = array($id);
        return self::getExecute($sql, $data);
    }

    static public function getPositionNane($id){
        $sql = "SELECT * FROM position_data WHERE id = ?";
        $data = array($id);
        $resData = self::getExecute($sql, $data);
        foreach($resData as $item){
            return $item['positionName'];
        }

        return null;
    }    
}