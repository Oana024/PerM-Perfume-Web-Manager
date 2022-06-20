<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../Entity/Order.php';

$database = new Database();
$db = $database->getConnection();

$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$path = parse_url($fullUrl, PHP_URL_QUERY);
$segments = explode('=', $path);
$id = end($segments);

$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$newStock = $row['stock'] - 1;
$update_stmt = $db->prepare("UPDATE products SET stock = ? WHERE id = ?");
$update_stmt->bind_param("is", $newStock, $id);
$update_stmt->execute();

$order = new Order($db);

$order -> setProductId($id);
$uid = $_SESSION['userId'];
$order -> setUserId($uid);

if($order -> create()){
    http_response_code(200);
    echo "Successfully ordered";
} else{
    http_response_code(400);
    echo "Failed";
}

header("Location: ../../product-page.php?product=$id");
