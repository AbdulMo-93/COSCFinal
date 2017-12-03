<?php

require_once '../database.php';
require_once '../core/config.php';

$cityId = $_GET['city'];
$ageUnder = $_GET['age'];

$db = db_connect();
$statement = $db->prepare("select * from tbl_client "
        . "where TIMESTAMPDIFF(YEAR,dob,CURDATE()) <= :ageUnder "
        . "and city = :cityId;");
$statement->bindValue(':ageUnder', $ageUnder);
$statement->bindValue(':cityId', $cityId);
$statement->execute();
$clients = $statement->fetchAll(PDO::FETCH_ASSOC);

$json = array();
foreach ($rows as $row) {
    $json[] = array(
        'id'    => $row['id'],
        'name'  => $row['name'],
        'dob'   => $row['dob'],
        'email' => $row['email'],
        'phone' => $row['phone']
    );
}

echo json_encode($json);
