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

if ($result->num_rows > 0) {
    $userRecords = array();
    $userRecords["users"] = array();
    while ($user = $result->fetch_assoc()) {
        extract($user);
        $userDetails = array(
            "id" => $id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "birthdate" => $birthdate,
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "gender" => $gender,
            "favourite_taste" => $favourite_taste
        );
        array_push($userRecords["users"], $userDetails);
    }
    http_response_code(200);
    echo json_encode($userRecords);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No user found.")
    );
}
?>