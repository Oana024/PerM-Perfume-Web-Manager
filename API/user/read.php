<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../Entity/User.php';

$database = new Database();
$db = $database->getConnection();

$users = new User($db);

$users->setId((isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0');

$result = $users->read();

$row = $result->fetch_assoc();

echo $row['first_name'] . " " . $row['last_name'] . " " . $row['birthdate'] . " " . $row['username'] . " " .
     $row['email'] . " " . $row['gender'] . " " . $row['favourite_taste'];
?>