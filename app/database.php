<?php

function db_connect(){
    try{
        $db =new PDO('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_DATABASE . ';charset=utf8', DB_USER, DB_PASS);
        return $db;
    } catch (Exception $ex) {

    }
}