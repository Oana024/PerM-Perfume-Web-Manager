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
                    <a id='acc'>Account</a>
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

<main id = "main">
  <div class="produse">
    <div class="c1">Produs 1</div>
    <div class="c2">Produs 2</div>
    <div class="c3">Produs 3</div>
    <div class="c4">Produs 4</div>
    <div class="c5">Produs 5</div>
    <div class="c6">Produs 6</div>
    <div class="c7">Produs 7</div>
    <div class="c8">Produs 8</div>
    <div class="c9">Produs 9</div>
  </div>
</main>

<footer id="footer">
  <button id="report" onclick="window.location.href='report/Report.html'">
    Report
  </button>
</footer>

</body>
</html>
