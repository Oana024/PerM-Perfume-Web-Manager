<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../Entity/Comment.php';

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$path = parse_url($fullUrl, PHP_URL_QUERY);
$segments = explode('=', $path);
$id = end($segments);

$comment->setProductId($id);
$comment->setUserId($_SESSION['userId']);
$comment->setReview($_POST['add-comment']);

if (!empty($comment->getReview())){
    if ($comment->create()) {
        http_response_code(200);
        header("Location: ../../product-page.php?product=$id");
        exit();
    } else {
        http_response_code(400);
        header("Location: ../../product-page.php?product=$id");
        exit();
    }
}
header("Location: ../../product-page.php?product=$id");
