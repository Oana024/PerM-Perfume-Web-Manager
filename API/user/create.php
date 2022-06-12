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

    if($user->verify()) {
        if ($user->create()) {
            http_response_code(201);
            $errors[] = "Item was created.";
          //  echo json_encode(array("message" => "Item was created."));
          //  echo "Item was created.";
        } else {
            http_response_code(503);
          //  echo json_encode(array("message" => "Unable to create item."));
            $errors[] = "Unable to create item.";
        }
    }
    else{
        http_response_code(409);
       // echo json_encode(array("message" => "Unable to create account. Email already used"));
        $errors[] = "Unable to create account. Email already used";
    }
} else {
    http_response_code(400);
    //echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
    $errors[] =  "Unable to create item. Data is incomplete.";
}

    print_r($errors);
