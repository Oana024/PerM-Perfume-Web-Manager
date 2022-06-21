<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About</title>
    <link rel="stylesheet" href="About.css">
    <style>
        body {background: url(https://img.uquiz.com/content/images/quiz_share_images/1597919473.jpg);}
    </style>
</head>
<body>

<header id="header">
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

        <button id = "help" onclick="window.location.href='Help.php'">
            Help
        </button>

        <button id = "about" onclick="window.location.href='About.php'">
            About
        </button>

    </div>
</header>


<main id="main">
    <div id="about-us">
        <h1 id="h1">ABOUT US</h1>
        <p id="text">
            Perfume-Web-Manager este o resursa web care se ocupa cu managementul resurselor dintr-o parfumerie. Utilizatorii isi pot crea un cont in pagina de "Sign Up" a aplicatiei, iar
            astfel ii vor fi recomandate parfumuri dupa profilul selectat (grupe de parfumuri). Utilizatorul va putea filtra parfumurile dupa anumite filtre (ocazie, anotimp, brand).
            Fiecare produs are proprietati specifice, ingredientele utilizate, pretul parfumului, tag-uri asociate. De asemenea utilizatorul poate comanda un produs la o anumita adresa.
        </p>
    </div>
    <div id="team">
        <h2 id="echipa"> Meet the Team </h2>
        <div id="persons">
            <div class="person">
                <div style="background-image: url(img/product/oana.jpg)"></div>
                <h1 class="name"> Mocanu Ioana-Isabela </h1>
                <p  class="description">Student at FII</p>
            </div>
            <div class="person">
                <div style="background-image: url(img/product/andreea.jpg)"></div>
                <h1 class="name"> Roca Andreea </h1>
                <p  class="description">Student at FII</p>
            </div>
        </div>
    </div>
</main>

</body>
</html>