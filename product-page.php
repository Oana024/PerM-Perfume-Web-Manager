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
        body {
            background: url(imageback.png);
        }
    </style>
</head>
<body>
<header id="header">
    <div id="head">
        <button id="logo" onclick="window.location.href='index.php'">
            Perfume-Web-Manager
        </button>

        <?php
        if (isset($_SESSION['userId'])) {
            echo "
                        <a id='logout' href='API/user/logout.php'>Logout</a>
                        <a id='acc' href='myAccount.php'>Account</a>
                    ";
        } else {
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

        <button id="help" onclick="window.location.href='Help.php'">
            Help
        </button>

        <button id="about" onclick="window.location.href='About.php'">
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
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<section id="product-detail" class="section1">
    <div class="product-image">
        <img src="img/product/<?php echo $row['url_image'] ?>" width="100%" id="MainImg" alt="">
    </div>
    <div class="product-details">
        <h4><?php echo $row['brand'] ?></h4>
        <h2><?php echo $row['name'] ?></h2>
        <h4>Eau de Parfume for <?php echo $row['gender'] ?></h4>
        <h6>Price: <?php echo $row['price'] ?> $</h6>

        <?php
        if(!isset($_SESSION['userId'])) {
            echo '<p id = "fail">You need to be connected to order</p>';
        }
        else if ($row['stock'] > 0) {
            echo '
                    <button type="submit" onclick="openPopup()"> Order </button>
                    <div class="popup" id="popup">
                        <form id="comanda" action="API/order/order.php?product-id='.$id.'" method="POST">
                            <label class="label" for="firstname">First Name</label>
                            <input class="input" type="text" id="firstname" name="firstname" placeholder="First Name" required><br><br>
                            
                            <label class="label" for="lastname">Last Name</label>
                            <input class="input" type="text" id="lastname" name="lastname" placeholder="Last Name" required><br><br>
                            
                            <label class="label" for="phone">Phone Number</label>
                            <input class="input" type="tel" id="phone" name="phone" placeholder="Phone Number" required><br><br>
                            
                            <label class="label" for="email">Email</label>
                            <input class="input" type="email" id="email" name="email" placeholder="Email" required><br><br>
                            
                            <label class="label" for="address">Address</label>
                            <input class="input" type="text" id="address" name="address" placeholder="Address" required><br><br>
                            
                            <button name="submit">Submit</button>
                            <button name="close" onclick="closePopup()">Close</button>
                        </form>
                    </div>
                ';
        } else {
            echo '<p id = "fail"> UNAVAILABLE </p>';
        }
        ?>

        <h2>Description</h2>
        <span><?php echo $row['description'] ?></span>
    </div>
</section>

<script>
    let popup = document.getElementById("popup");

    function openPopup() {
        popup.classList.add("open-popup");
    }

    function closePopup() {
        popup.classList.remove("open-popup");
    }
</script>

<section id="product-detail1" class="section1">
    <div class="details">
        Product Details
        <p id="title">Season</p>
        <p id="description">- <?php echo $row["season"]?></p>

        <p id="title">Event</p>
        <p id="description">- <?php echo $row["occasion"]?></p>

        <p id="title">Brand</p>
        <p id="description">- <?php echo $row["brand"]?></p>

        <p id="title">Taste</p>
        <p id="description">- <?php echo $row["taste"]?></p>

        <p id="title">Ingredients</p>
        <p id="description">- <?php echo $row["ingredients"]?></p>
    </div>
    <div class="taggs">
        <div class="taggs">Associate Taggs</div>

        <a id='button' href='index.php?brand=<?php $brandFilter = str_replace(" ", "_", $row["brand"]);
        echo $brandFilter?>'><?php echo $row["brand"]?></a>
        <a id='button' href='index.php?event=<?php $eventFilter = str_replace(" ", "_", $row["occasion"]);
        echo $eventFilter?>'><?php echo $row["occasion"]?></a>
        <a id='button' href='index.php?season=<?php echo $row["season"]?>'><?php echo $row["season"]?></a>
    </div>
</section>
<section class="product-links">
    <div class="wrapper">
        <p id="title1">You might like..</p>
        <div class="product-container">
            <?php
            $stmt1 = $db->prepare("SELECT * FROM products WHERE brand = ? AND id != ? LIMIT 3");
            $stmt1 -> bind_param("ss", $row["brand"], $row["id"]);
            $stmt1 -> execute();
            $result1 = $stmt1->get_result();

            while($row1 = mysqli_fetch_assoc($result1)) {
                echo '<a href="product-page.php?product='.$row1["id"].'">
                                <div style="background-image: url(img/product/'.$row1["url_image"].')"></div>
                                    <h1 id="name">'.$row1["name"].'</h1>
                                    <p  id="price">'.$row1["price"].' $</p>
                                </a>';
            }
            ?>
        </div>

    </div>
</section>
<section id="product-comments" class="section1">
    <p id="title2">Comments</p>
    <div id="comments-container">
        <?php
        $stmt1 = $db->prepare("SELECT * FROM comments WHERE product_id = ? ORDER BY id DESC");
        $stmt1 -> bind_param("i",$id);
        $stmt1 -> execute();
        $result1 = $stmt1->get_result();

        while($row1 = mysqli_fetch_assoc($result1)) {
            $stmt2 = $db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt2 -> bind_param("i",$row1["user_id"]);
            $stmt2 -> execute();
            $result2 = $stmt2->get_result();
            $row2 = $result2->fetch_assoc();
            echo ' <div id="single-comment">
                        <h1 id="username">'.$row2["username"].'</h1>
                        <p  id="comment">'.$row1["review"].'</p>
                   </div>';
        }
        ?>
    </div>
    <div class="comment-form">
        <h1 id="username">Add a comment...</h1>
        <?php
        if(!isset($_SESSION['userId'])) {
            echo '<p id = "fail">You need to be connected to add a comment</p>';
        } else {
            echo   '
        <form id="comment-field" action="API/comment/create.php?product-id='.$id.'" method="POST">
                    <input type="text" id="add-comment" name="add-comment" placeholder="Comment" required><br><br>
                    <button id="button" name="submit">
                        Submit
                    </button>
        </form>';
            }
            ?>
    </div>
</section>
</body>
</html>
