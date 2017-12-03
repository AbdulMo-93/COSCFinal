<?php

class Client{
    public $id;
    public $name;
    public $dob;
    public $email;
    public $phone;
    public $city;
    public $note;
    public $createdBy;
    public $updatedBy;
    public $createdDate;
    public $updatedDate;
    
    public function __construct() {}
    
    public function perform($action){
        echo 'in perform';
        echo $action;
        if($action == 'add') $this->add();
        else if($action == 'update') $this->update();
    }
    
    private function add(){
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO tbl_client "
                . "values(:id, :name, :dob, :email, :phone, :city, :createdBy, :updatedBy, :createdDate, :updatedDate, :note);");
        $statement->bindValue(':id',            $this->id);
        $statement->bindValue(':name',          $this->name);
        $statement->bindValue(':dob',           $this->dob);
        $statement->bindValue(':email',         $this->email);
        $statement->bindValue(':phone',         $this->phone);
        $statement->bindValue(':city',          $this->city);
        $statement->bindValue(':createdBy',     $this->createdBy);
        $statement->bindValue(':updatedBy',     $this->updatedBy);
        $statement->bindValue(':createdDate',   $this->createdDate);
        $statement->bindValue(':updatedDate',   $this->updatedDate);
        $statement->bindValue(':note',          $this->note);
        $statement->execute();
    }
    
    private function update(){
        $db = db_connect();
        $statement = $db->prepare("UPDATE tbl_client "
                . "set  name    = :name, "
                . "     dob     = :dob, "
                . "     email   = :email, "
                . "     phone   = :phone, "
                . "     city    = :city, "
                . "     note    = :note, "
                . "     updatedBy = :updatedBy, "
                . "     updatedDate = :updatedDate "
                . "where id = :id;");
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':dob', $this->dob);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':phone', $this->phone);
        $statement->bindValue(':city', $this->city);
        $statement->bindValue(':note', $this->note);
        $statement->bindValue(':updatedBy', $this->updatedBy);
        $statement->bindValue(':updatedDate', $this->updatedDate);
        $statement->bindValue(':id', $this->id);
        $statement->execute();
    }
    
    public function getProvinces(){
        $db = db_connect();
        $statement = $db->prepare("select * from tbl_province");
        $statement->execute();
        $provinces = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $provinces;
    }
    
    public function getClients(){
        $db = db_connect();
        $statement = $db->prepare("select *, cl.name as client_name, ci.name as city_name, cl.id as client_id "
                . "from tbl_client cl, tbl_city ci "
                . "where cl.city = ci.id;");
        $statement->execute();
        $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $clients;
    }
    
    public function getPhones(){
        $db = db_connect();
        $statement = $db->prepare("select name, phone from tbl_client;");
        $statement->execute();
        $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $clients;
    }
    
    public function getClient($client){
        $db = db_connect();
        $statement = $db->prepare("select *, "
                . "     cl.id as client_id, "
                . "     cl.name as client_name, "
                . "     ci.id as city_id, "
                . "     ci.name as city_name "
                . "from tbl_client cl, tbl_city ci "
                . "where cl.city = ci.id and cl.id = :id;");
        $statement->bindValue(':id', $client->id);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($rows){
            $client->name = $rows[0]['client_name'];
            $client->dob = $rows[0]['dob'];
            $client->email = $rows[0]['email'];
            $client->phone = $rows[0]['phone'];
            
            $client->city->id = $rows[0]['city_id'];
            $client->city->name = $rows[0]['city_name'];
            $client->city->province = $rows[0]['province_name'];
            
            $client->note = $rows[0]['note'];
        }
        return $client;
    }
    
    public function getReport($cityId, $ageUnder){
        $db = db_connect();
        $statement = $db->prepare("select * from tbl_client "
                . "where TIMESTAMPDIFF(YEAR,dob,CURDATE()) <= :ageUnder "
                . "and city = :cityId;");
        $statement->bindValue(':ageUnder', $ageUnder);
        $statement->bindValue(':cityId', $cityId);
        $statement->execute();
        $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $clients;
    }
}