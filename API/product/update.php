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

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->name) && !empty($data->brand) && !empty($data->gender) &&
    !empty($data->price) && !empty($data->description) && !empty($data->stock) &&
    !empty($data->season) && !empty($data->occasion) && !empty($data->taste) &&
    !empty($data->url_image) && !empty($data->ingredients)) {

    $items->setId($data->id);
    $items->setName($data->name);
    $items->setBrand($data->brand);
    $items->setGender($data->gender);
    $items->setPrice($data->price);
    $items->setDescription($data->description);
    $items->setStock($data->stock);
    $items->setSeason($data->season);
    $items->setOccasion($data->occasion);
    $items->setTaste($data->taste);
    $items->setUrlImage($data->url_image);
    $items->setIngredients($data->ingredients);

    if ($items->update()) {
        http_response_code(200);
        echo json_encode(array("message" => "Item was updated."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update items."));
    }

} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update items. Data is incomplete."));
}
?>