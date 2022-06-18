<?php
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product</title>
    <link rel="stylesheet" href="product-page.css">
    <style>
        body {background: url(https://img.uquiz.com/content/images/quiz_share_images/1597919473.jpg);}
    </style>
</head>
<body>
<header id = "header">
    <div id = "head">
        <button id="logo" onclick="window.location.href='index.php'">
            Perfume-Web-Manager
        </button>

        <?php
        if(isset($_SESSION['userId'])) {
            echo "
                        <a id='logout' href='API/user/logout.php'>Logout</a>
                        <a id='acc' href='myAccount.php'>Account</a>
                    ";
        }
        else {
            echo "
                    <button id = \"login\" onclick=\"window.location.href='Login.php'\">
                      Login
                    </button>
    
                    <button id = \"signup\" onclick=\"window.location.href='Signup.php'\">
                      Sign Up
                    </button>
                    ";
        }
        ?>

        <button id = "help" onclick="window.location.href='help/Help.html'">
            Help
        </button>

        <button id = "about" onclick="window.location.href='about/About.html'">
            About
        </button>
    </div>
</header>
<?php
include_once 'API/config/Database.php';

$database = new Database();
$db = $database->getConnection();

$path = parse_url($fullUrl, PHP_URL_QUERY);
$segments = explode('=', $path);
$id = end($segments);

$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt -> bind_param("s", $id);
$stmt -> execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<section id="product-detail" class="section1">
    <div class="product-image">
        <img src="img/product/<?php echo $row['url_image']?>" width="100%" id="MainImg" alt="">
    </div>
    <div class="product-details">
        <h4><?php echo $row['brand']?></h4>
        <h2><?php echo $row['name']?></h2>
        <h4>Eau de Parfume for <?php echo $row['gender']?></h4>
        <h6>Price: <?php echo $row['price']?> $</h6>

        <?php
        if ($row['stock'] > 1) {
            echo '<button> Command </button>';
        } else {
            echo '<p id = "fail"> INDISPONIBLE </p>';
        }
        ?>
        <h2>Description</h2>
        <span><?php echo $row['description']?></span>
    </div>
</section>

<section id="product-detail1" class="section1">
    <div class="details">
        Product Details
        <p id="title">Season</p>
        <p id="description">- <?php echo $row["season"]?></p>

        <p id="title">Event</p>
        <p id="description">- <?php echo $row["occasion"]?></p>

        <p id="title">Brand</p>
        <p id="description">- <?php echo $row["brand"]?></p>

        <p id="title">Ingredients</p>
        <p id="description">- <?php echo $row["ingredients"]?></p>
    </div>
    <div class="taggs">
        Associate Taggs
    </div>
</section>
<section class = "product-links">
    <div class="wrapper">
        <p id="asociate-products">You might like..</p>
        <div class="product-container">
            <?php

            include_once 'API/Config/Database.php';

            $database = new Database();
            $db = $database->getConnection();

            $stmt1 = $db->prepare("SELECT * FROM products WHERE brand = ? AND id != ? LIMIT 3");
            $stmt1 -> bind_param("ss", $row["brand"], $row["id"]);
            $stmt1 -> execute();
            $result1 = $stmt1->get_result();

            while($row1 = mysqli_fetch_assoc($result1)) {
                echo '<a href="product-page.php?product='.$row1["id"].'">
                                <div></div>
                                    <h1 id="name">'.$row1["name"].'</h1>
                                    <p  id="price">'.$row1["price"].' $</p>
                                </a>';
            }
            ?>
        </div>

    </div>
</section>
<section id="product-comments" class="section1">
    COMENTARII DE ADAUGAT
</section>

</body>
</html>
