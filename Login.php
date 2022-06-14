<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
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

        <button id = "login" onclick="window.location.href='Login.php'">
            Login
        </button>

        <button id = "signup" onclick="window.location.href='Signup.php'">
            Sign Up
        </button>

        <button id = "help" onclick="window.location.href='help/Help.html'">
            Help
        </button>

        <button id = "about" onclick="window.location.href='about/About.html'">
            About
        </button>


    </div>
</header>
<main id = "main">
    <form class="login-form" action = "API/user/login.php" method="POST">
        <h1>Login</h1>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>

        <label for="pswd">Password</label>
        <input type="password" id="pswd" name="pswd" placeholder="Password" required><br><br>
        <button id = "log_in">
            Login
        </button>
    </form>

    <?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($fullUrl, "login=user") == true) {
        echo '<p class="error"> This user does not exist!</p>';
        exit();
    }
    elseif (strpos($fullUrl, "login=password") == true) {
        echo '<p class="error"> Password is incorrect!</p>';
        exit();
    }
    ?>
</main>
</body>
</html>