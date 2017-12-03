<?php
require_once '../database.php';
require_once '../core/config.php';

$provinceName = $_GET['province_name'];
$db = db_connect();
$statement = $db->prepare("select * from tbl_city where province_name = :province_name");
$statement->bindValue(':province_name', $provinceName);
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

$json = array();
foreach($rows as $row){
    $json[] = array(
        'id' => $row['id'],
        'name' => $row['name']
    );
}

echo json_encode($json);