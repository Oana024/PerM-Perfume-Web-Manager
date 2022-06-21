<?php
require('C:/xampp/htdocs/PerM-Perfume-Web-Manager/API/vendor/autoload.php');
$openapi = \OpenApi\Generator::scan(['C:/xampp/htdocs/PerM-Perfume-Web-Manager/API/Entity']);
header('Content-Type: application/json');
echo $openapi->toJSON();