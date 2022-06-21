<?php
include_once '../API/config/Database.php';

$database = new Database();
$db = $database->getConnection();


echo "<h2>
        Stocuri existente
    </h2>";

$stmt = $db->prepare("SELECT name, stock FROM products ORDER BY stock DESC");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
    echo "<br>";
}

echo "<h2>
        Situatii vanzari
    </h2>
    <div>
        <h3>
            Categoria de parfumuri
        </h3>
        <div>
            <h4>
                In functie de brand
            </h4>";

$stmt = $db->prepare("SELECT brand, COUNT(brand) FROM orders GROUP BY brand");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
    echo "<br>";
}

echo "<h4>
                In functie de ocazie
            </h4>";

$stmt = $db->prepare("SELECT occasion, COUNT(occasion) FROM orders GROUP BY occasion");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
    echo "<br>";
}

echo "<h4>
                In functie de aroma parfumurilor
            </h4>";

$stmt = $db->prepare("SELECT taste, COUNT(taste) FROM orders GROUP BY taste");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
    echo "<br>";
}

echo "<h3>
        Vanzari in functie de profilul utilizatorului
    </h3>";

$stmt = $db->prepare("SELECT user_gender, COUNT(user_gender) FROM orders GROUP BY user_gender");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
    echo "<br>";
}

echo "<h3>
        Vanzari in functie de anotimp
    </h3>";

$stmt = $db->prepare("SELECT season, COUNT(season) FROM orders GROUP BY season");
$stmt -> execute();
$result = $stmt->get_result();

while($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
    echo "<br>";
}
