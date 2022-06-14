<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="myAccount.css">
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

        <a id='logout' href='API/user/logout.php'>Logout</a>
        <a id='acc' href='myAccount.php'>Account</a>

        <button id = "help" onclick="window.location.href='Help.php'">
            Help
        </button>

        <button id = "about" onclick="window.location.href='About.php'">
            About
        </button>


    </div>
</header>
<main id = "main">
    <form>
        <h1>My Account</h1>
        <label for="user_name">User name</label>
        <input type="text" id="user_name" name="user_name" placeholder="User name"><br><br>

        <label for="pswd">Password</label>
        <input type="text" id="pswd" name="pswd" placeholder="Password"><br><br>
        <button id = "log_in">
            Login
        </button>
    </form>
</main>
</body>
</html>