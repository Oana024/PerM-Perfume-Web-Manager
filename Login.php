<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
    <style>
        body {
            background: url(https://img.uquiz.com/content/images/quiz_share_images/1597919473.jpg);
        }
    </style>
</head>
<body>
<header id="header">
    <div id="head">
        <button id="logo" onclick="window.location.href='index.php'">
            Perfume-Web-Manager
        </button>

        <button id="login" onclick="window.location.href='Login.php'">
            Login
        </button>

        <button id="signup" onclick="window.location.href='Signup.php'">
            Sign Up
        </button>

        <button id="help" onclick="window.location.href='help/Help.html'">
            Help
        </button>

        <button id="about" onclick="window.location.href='about/About.html'">
            About
        </button>


    </div>
</header>
<main id="main">
    <div class="login-form">
        <h1>Login</h1>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>

        <label for="pswd">Password</label>
        <input type="password" id="pswd" name="pswd" placeholder="Password" required><br><br>
        <button id="log_in" type="submit" onclick="loginUser()">
            Login
        </button>
        <br>

        <p id="response"></p>
    </div>

    <script>
        function loginUser() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("response").innerHTML = this.responseText;
                    window.location.replace("index.php");
                }
                else {
                    document.getElementById("response").innerHTML = this.responseText;
                }
            };

            var username = document.getElementById('username').value;
            var password = document.getElementById('pswd').value;

            xhttp.open("POST", "API/user/login.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("username=" + username + "&pswd=" + password);
        }
    </script>
</main>
</body>
</html>