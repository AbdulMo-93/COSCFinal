<?php

class Reminder {
    public $id;
    public $username;
    public $subject;
    public $description;
    public $createdDate;
    public $deleted;

    public function __construct() {
        
    }

    public function get_reminders() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM tbl_reminder "
                . "WHERE Username = :username "
                . "     AND deleted = 0;");
        $statement->bindValue(':username', $_SESSION['username']);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function get_reminder($id) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM tbl_reminder "
                . "WHERE id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($rows){
            $this->id = $rows[0]['id'];
            $this->subject = $rows[0]['subject'];
            $this->description = $rows[0]['description'];
        }
        return $this;
    }

    public function remove($id) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE tbl_reminder "
                . "SET deleted = 1 "
                . "WHERE id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public function update() {
        $db = db_connect();
        $statement = $db->prepare("UPDATE tbl_reminder "
                . "SET  `subject` = :subject, "
                . "     `description` = :description, "
                . "     `Username` = :username "
                . "WHERE id = :id;");
        $statement->bindValue(':subject', $this->subject);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':username', $_SESSION['username']);
        $statement->bindValue(':id', $this->id);
        $statement->execute();
    }

    public function add() {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO tbl_reminder "
                . "VALUES(:id, :username, :subject, :description, :createdDate, :deleted); ");
        $statement->bindValue(':id', null);
        $statement->bindValue(':subject', $this->subject);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':createdDate', date('Y-m-d H:i:s'));
        $statement->bindValue(':deleted', 0);
        $statement->bindValue(':username', $_SESSION['username']);
        $statement->execute();
    }

    public function getReport($mostReminder = null, $from = null, $to = null, $totalLogin = null) {
        $db = db_connect();
        $query = "SELECT * FROM tbl_reminder r inner join tbl_log l on r.username = l.username where deleted = 0";

        if ($from != null) {
            $query .= " and createdDate >= '" . $from . "'";
        }

        if ($to != null) {
            $query .= " and createdDate <= '" . $to . "'";
        }

        if ($mostReminder != null) {
            $query .= " and attempts = (select max(attempts) from tbl_log)";
        }

        if ($totalLogin != null) {
            $query .= " and attempts = " . $totalLogin;
        }

        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

}
