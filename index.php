<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PerM</title>
  <link rel="stylesheet" href="mainpage.css">
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


<!--    <button id = "login" onclick="window.location.href='Login.php'">-->
<!--      Login-->
<!--    </button>-->
<!---->
<!--    <button id = "signup" onclick="window.location.href='Signup.php'">-->
<!--      Sign Up-->
<!--    </button>-->

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

  <div class="dropdown-1">
    <button class="dropbtn-1">Season</button>
    <div class="dropdown-content-1">
      <a href="#">Winter</a>
      <a href="#">Spring</a>
      <a href="#">Summer</a>
      <a href="#">Fall</a>
    </div>
  </div>

  <div class="dropdown-2">
    <button class="dropbtn-2">Event</button>
    <div class="dropdown-content-2">
      <a href="#">Special Event</a>
      <a href="#">Daily Use</a>
    </div>
  </div>

  <div class="dropdown-3">
    <button class="dropbtn-3">Brand</button>
    <div class="dropdown-content-3">
      <a href="#">Hugo Boss</a>
      <a href="#">Calvin Klein</a>
      <a href="#">Armani</a>
    </div>
  </div>

</nav>

<main id="main">
    <section class = "product-links">
        <div class="wrapper">
            <div class="product-container">
                <?php

                    include_once 'API/Config/Database.php';

                    $database = new Database();
                    $db = $database->getConnection();

                    $stmt = $db->prepare("SELECT * FROM products");
                    $stmt -> execute();
                    $result = $stmt->get_result();

                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="product-page.php?product='.$row["id"].'">
                                <div></div>
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
