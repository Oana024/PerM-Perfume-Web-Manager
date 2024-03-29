<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help</title>
    <link rel="stylesheet" href="Help.css">
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
    <h1 id="h1">Intrebari frecvente</h1>
    <p class="q">Cum imi fac cont?</p>
    <p class="a">Click pe butonul "Sign Up" din dreapta sus.</p>

    <p class="q">Cum ma conectez la contul meu?</p>
    <p class="a">Click pe butonul "Login" din dreapta sus.</p>

    <p class="q">Cum filtrez produsele?</p>
    <p class="a">In meniul principal in sectiunea "Filters" selectezi optiunea dorita.</p>

    <p class="q">Cum imi vizualizez profilul?</p>
    <p class="a">Dupa conectarea la cont din "Login", click pe butonul "Account" din dreapta sus.</p>

    <p class="q">Cum ma deconectez?</p>
    <p class="a">Dupa conectarea la cont din "Login", click pe butonul "Logout" din dreapta sus.</p>

    <p class="q">Cum vizualizez un produs?</p>
    <p class="a">Click pe produsul dorit din meniul principal.</p>

    <p class="q">Cum adaug un comentariu la un produs?</p>
    <p class="a">Pe pagina produsului, dupa conectarea la cont, la finalul paginii adaugati textul in campul pentru comentariu dupa care dati "Submit".</p>

    <p class="q">Cum comand un produs?</p>
    <p class="a">Pe pagina produsului, dupa conectarea la cont, apasati pe butonul "Order", completati campurile din formular dupa care dati "Submit".</p>

</main>

</body>
</html>