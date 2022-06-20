<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PerM</title>
    <link rel="stylesheet" href="mainpage.css">
    <style>
        body {background: url(imageback.png);}
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

<nav id="nav">
    <div id="filters">
        Filters
    </div>

    <?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $array1 = explode("/", $fullUrl);
    $short_url = end($array1);
   // echo $short_url;

    echo '<div class="dropdown-1">
        <button class="dropbtn-1">Season</button>
        <div class="dropdown-content-1">
            <a href="'.$short_url.'?season=Winter">Winter</a>
            <a href="'.$short_url.'?season=Spring">Spring</a>
            <a href="'.$short_url.'?season=Summer">Summer</a>
            <a href="'.$short_url.'?season=Fall">Fall</a>
        </div>
    </div>';

    echo '<div class="dropdown-2">
        <button class="dropbtn-2">Event</button>
        <div class="dropdown-content-2">
            <a href="'.$short_url.'?event=Special_Event">Special Event</a>
            <a href="'.$short_url.'?event=Daily_Use">Daily Use</a>
        </div>
    </div>';

    echo '<div class="dropdown-3">
        <button class="dropbtn-3">Brand</button>
        <div class="dropdown-content-3">
            <a href="'.$short_url.'?brand=Hugo_Boss">Hugo Boss</a>
            <a href="'.$short_url.'?brand=Calvin_Klein">Calvin Klein</a>
            <a href="'.$short_url.'?brand=Armani">Armani</a>
            <a href="'.$short_url.'?brand=Lancome">Lancome</a>
            <a href="'.$short_url.'?brand=Paco_Rabanne">Paco Rabanne</a>
            <a href="'.$short_url.'?brand=Chanel">Chanel</a>
            <a href="'.$short_url.'?brand=Yves_Saint_Laurent">Yves Saint Laurent</a>
            <a href="'.$short_url.'?brand=Diesel">Diesel</a>
        </div>
    </div>';
    ?>

</nav>

<main id="main">
    <section class = "product-links">
        <div class="wrapper">
            <div class="product-container">
                <?php

                include_once 'API/Config/Database.php';
                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $database = new Database();
                $db = $database->getConnection();

                $url_components = parse_url($fullUrl, PHP_URL_QUERY);
                $filters = explode("?", $url_components);

                $brandFilter = null;
                $seasonFilter = null;
                $eventFilter = null;
                for($i = 0; $i < count($filters); $i++){
                    if(strpos($filters[$i], "season") !== false){
                        $array = explode("=", $filters[$i]);
                        $seasonFilter = $array[1];
                    }
                    if(strpos($filters[$i], "event") !== false){
                        $array = explode("=", $filters[$i]);
                        $eventFilter = str_replace("_", " ", $array[1]);
                    }
                    if(strpos($filters[$i], "brand") !== false){
                        $array = explode("=", $filters[$i]);
                        $brandFilter = str_replace("_", " ", $array[1]);
                    }
                }

                $sql_stmt = "SELECT * FROM products";

                $first = false;

                if($seasonFilter != null) {
                    if($first == false) {
                        $first = true;
                        $sql_stmt = $sql_stmt . " WHERE season='$seasonFilter'";
                    }
                }
                if($eventFilter != null) {
                    if($first == false) {
                        $first = true;
                        $sql_stmt = $sql_stmt . " WHERE occasion='$eventFilter'";
                    }
                    else{
                        $sql_stmt = $sql_stmt . " AND occasion='$eventFilter'";
                    }
                }
                if($brandFilter != null) {
                    if($first == false) {
                        $first = true;
                        $sql_stmt = $sql_stmt . " WHERE brand='$brandFilter'";
                    }
                    else{
                        $sql_stmt = $sql_stmt . " AND brand='$brandFilter'";
                    }
                }

                $stmt = $db->prepare($sql_stmt);
                $stmt -> execute();
                $result = $stmt->get_result();

                while($row = mysqli_fetch_assoc($result)) {
                    echo '<a href="product-page.php?product='.$row["id"].'">
                            <div style="background-image: url(img/product/'.$row["url_image"].')"></div>
                                <h1 id="name">'.$row["name"].'</h1>
                                <p  id="price">'.$row["price"].' $</p>
                            </a>';
                }
                ?>
            </div>
        </div>
    </section>
</main>

<footer id="footer">
    <button id="report" onclick="window.location.href='report/Report.html'">
        Report
    </button>
</footer>

</body>
</html>
