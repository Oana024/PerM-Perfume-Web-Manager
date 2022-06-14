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

$data = new User($db);

$data->setUsername($_POST['username']);
$data->setPassword($_POST['pswd']);

if(!(empty($data->getUsername())) || !(empty($data->getPassword()))){
    $result = $data->validUser();
    if($result == -1){
        header('Location: ../../Login.php?login=user');
        exit();
    }
    else if($result == -2){
        header('Location: ../../Login.php?login=password');
        exit();
    }
    else{
        session_start();
        $_SESSION['userId'] = $result;
        header('Location: ../../index.php?login=success');
        exit();
    }
}


?>
