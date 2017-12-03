<?php

class User {

    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $email;
    public $role;
    public $managedBy;

    public function __construct() {
        
    }

    public function authenticate() {
        $db = db_connect();
        $statement = $db->prepare("select * from tbl_user where username = :username");
        $statement->bindValue(':username', $this->username);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            $hash_password = $rows[0]['password'];
            $password = $this->password;

            if (!password_verify($password, $hash_password)) {
                $statement = $db->prepare("select * from tbl_logfail where Username = :username;");
                $statement->bindValue(':username', $this->username);
                $statement->execute();
                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                $attempts = $rows[0]['attempts'];

                $statement = $db->prepare("update tbl_logfail set attempts = :attempts where Username = :username;");
                if ($attempts >= 3) {
                    sleep(60);
                    $statement->bindValue(':attempts', 0);
                } else if ($rows) {
                    $attempts += 1;
                    $statement->bindValue(':attempts', $attempts);
                } else {
                    $statement = $db->prepare("insert into tbl_logfail(username, attempts) values(:username, :attempts);");
                    $statement->bindValue(':attempts', 1);
                }
                $statement->bindValue(':username', $this->username);
                $statement->execute();
            } else {
                //Storing session.
                $_SESSION['username'] = $this->username;
                $_SESSION['role'] = $rows[0]['role'];
                return true;
            }
        }
        return false;
    }

    public function perform($action) {
        if ($action == 'add') {
            $this->add();
        } else if ($action == 'delete') {
            $this->delete();
        }
    }

    private function add() {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO tbl_user values(:username, :password, :firstName, :lastName, :email, :role, :managedBy);");
        $statement->bindValue(':username', $this->username);
        $statement->bindValue(':password', $this->password);
        $statement->bindValue(':firstName', $this->firstName);
        $statement->bindValue(':lastName', $this->lastName);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':role', $this->role);
        $statement->bindValue(':managedBy', $this->managedBy);
        $statement->execute();
    }

    private function delete() {
        $db = db_connect();
        $statement = $db->prepare("delete from tbl_user where username = :username");
        $statement->bindValue(':username', $this->username);
        $statement->execute();
    }

    public function getUsers() {
        $db = db_connect();
        $statement = $db->prepare("select * from tbl_user where role != 'admin'");
        $statement->bindValue(':role', 'manager');
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function updateLogInfo() {
        $db = db_connect();
        $statement = $db->prepare("select * from tbl_log where username = :username;");
        $statement->bindValue(':username', $_SESSION['username']);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            $statement = $db->prepare("update tbl_log "
                    . "set attempts = :attempts "
                    . "where username = :username");
            $statement->bindValue(':username', $_SESSION['username']);
            $statement->bindValue(':attempts', ++$rows[0]['attempts']);
        } else {
            $statement = $db->prepare("insert into tbl_log(username, attempts) "
                    . "values(:username, :attempts);");
            $statement->bindValue(':username', $_SESSION['username']);
            $statement->bindValue(':attempts', 1);
        }
        $statement->execute();
    }

}
