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

$gender='null';
if(!empty($_POST['gender'])) {
    foreach ($_POST['gender'] as $value)
        $gender = $value;
}

$data->setGender($gender);

$taste='null';
if(!empty($_POST['taste'])) {
    foreach ($_POST['taste'] as $value)
        $taste = $value;
}

$data->setFavouriteTaste($taste);


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
                header('Location: ../../Signup.php?signup=date');
                exit();
            }
            if ($user->create()) {
                header('Location: ../../index.php?signup=success');
                exit();
            } else {
                http_response_code(503);
                exit();
            }
        }
        else{
            //username already exists
            http_response_code(409);
            header('Location: ../../Signup.php?signup=username');
            exit();
        }
    }
    else if($result == 0){
        //wrong email format
        http_response_code(422);
        header('Location: ../../Signup.php?signup=format');
        exit();
    }
    else{
        //email already exists
        http_response_code(409);
        header('Location: ../../Signup.php?signup=email');
        exit();
    }
}
