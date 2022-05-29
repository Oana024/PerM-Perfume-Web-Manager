<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../Entity/Product.php';

$database = new Database();
$db = $database->getConnection();

$items = new Product($db);

$items->setId((isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0');

$result = $items->read();

if ($result->num_rows > 0) {
    $itemRecords = array();
    $itemRecords["items"] = array();
    while ($item = $result->fetch_assoc()) {
        extract($item);
        $itemDetails = array(
            "id" => $id,
            "name" => $name,
            "brand" => $brand,
            "gender" => $gender,
            "price" => $price,
            "description" => $description,
            "stock" => $stock
        );
        array_push($itemRecords["items"], $itemDetails);
    }
    http_response_code(200);
    echo json_encode($itemRecords);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No item found.")
    );
}
?>