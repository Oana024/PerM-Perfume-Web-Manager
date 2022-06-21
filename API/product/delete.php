<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../Entity/Product.php';

$database = new Database();
$db = $database->getConnection();

$items = new Product($db);

$items->setId((isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0');

$data = json_decode(file_get_contents("php://input"));

if ($items->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Item was deleted."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete item."));
}
?>