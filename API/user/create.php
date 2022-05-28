<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../Entity/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->first_name) && !empty($data->last_name) && !empty($data->birthdate)
    && !empty($data->username) && !empty($data->email) && !empty($data->password) && !empty($data->gender)) {

    $user->setFirstName($data->first_name);
    $user->setLastName($data->last_name);
    $user->setBirthdate($data->birthdate);
    $user->setUsername($data->username);
    $user->setEmail($data->email);
    $user->setPassword($data->password);
    $user->setGender($data->gender);
    $user->setFavouriteTaste($data->favourite_taste);

    if ($user->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Item was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create item."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
}
