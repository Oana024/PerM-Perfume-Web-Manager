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

$data = new User($db);

$data->setFirstName($_POST['first_name']);
$data->setLastName($_POST['last_name']);
$data->setBirthdate($_POST['birth_date']);
$data->setUsername($_POST['username']);
$data->setEmail($_POST['email']);
$data->setPassword($_POST['pswd']);
$data->setGender($_POST['gender']);
$data->setFavouriteTaste($_POST['taste']);

if (!empty($data->getFirstName()) && !empty($data->getLastName()) && !empty($data->getBirthdate())
    && !empty($data->getUsername()) && !empty($data->getEmail()) && !empty($data->getPassword()) && !empty($data->getGender())) {

    $user->setFirstName($data->getFirstName());
    $user->setLastName($data->getLastName());
    $user->setBirthdate($data->getBirthdate());
    $user->setUsername($data->getUsername());
    $user->setEmail($data->getEmail());
    $user->setPassword($data->getPassword());
    $user->setGender($data->getGender());
    $user->setFavouriteTaste($data->getFavouriteTaste());

    $result = $user->verifyEmail();

    if($result == 1) {
        if($user->verifyUsername()) {
            if(!$user->verifyDate()){
                http_response_code(400);
                echo "Wrong date format";
            }
            else
                if ($user->create()) {
                    http_response_code(200);
                    echo "Successfully registered";
                } else {
                    http_response_code(404);
                    echo "Error";
                }
        }
        else{
            http_response_code(409);
            echo "Username already exists";
        }
    }
    else if($result == 0){
        http_response_code(400);
        echo "Wrong email format";
    }
    else{
        http_response_code(409);
        echo "Email already exists";
    }
}

