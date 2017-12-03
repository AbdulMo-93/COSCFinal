<?php

class Util{
    public static function getHome(){
        return HOME;
    }
    
    public static function userLogin(){
        return USER_LOGIN;
    }
    
    public static function userLogout(){
        return LOGOUT;
    }
    
    public static function report(){
        return REPORT;
    }
    
    public static function phoneList(){
        return PHONE_LIST;
    }
    
    public static function addUser(){
        return USER_ADD;
    }
    
    public static function deleteUser(){
        return USER_DELETE;
    }
    
    /** CLIENT PART **/
    public static function addClient(){
        return CLIENT_ADD;
    }
    
    public static function editClient(){
        return CLIENT_EDIT;
    }
    
    public static function updateClient(){
        return CLIENT_UPDATE;
    }
    
    public static function getAttempts(){
        $currentDate = date('Y-m-d');
        $start = $currentDate . ' 00:00:00';
        $end = $currentDate . ' 23:59:59';
        $db = db_connect();
        $statement = $db->prepare(" SELECT sum(Attempt) as attempt "
                . "                 from `tbl_log` "
                . "                 where :start < `Time` and `Time` < :end"
                . "                 group by Username;");
        $statement->bindValue(':start', $start);
        $statement->bindValue(':end', $end);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $attempt = 0;
        
        foreach($rows as $row){
            $attempt += (int)$row['attempts'];
        }
        return $attempt;
    }
    
    public static function getLastLoggedDate() {
        $currentDate = date('Y-m-d H:i:s') ;
        $db = db_connect();
        $statement = $db->prepare(" SELECT * "
                . "                 FROM `tbl_log` "
                . "                 WHERE Username = :username; and loggedDate < :currentDate");
        $statement->bindValue(':username', $_SESSION['username']);
        $statement->bindValue(':currentDate', $currentDate);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows[0]['loggedDate'];
    }
    
    public static function getCurrentDate(){
        
    }
}

