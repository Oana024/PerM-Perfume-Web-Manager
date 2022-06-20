<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="Signup.css" type="text/css"/>
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
    <div id="sign-up-form">
        <h1>Sign up</h1>

        <label class="label" for="first_name">First Name</label>
        <input class="input" type="text" id="first_name" name="first_name" placeholder="First Name" required><br><br>

        <label class="label" for="last_name">Last Name</label>
        <input class="input" type="text" id="last_name" name="last_name" placeholder="Last Name" required><br><br>

        <label class="label" for="birth_date">Birth Date</label>
        <input class="input" type="text" id="birth_date" name="birth_date" placeholder="Birth Date" required><br><br>

        <label class="label" for="username">Username</label>
        <input class="input" type="text" id="username" name="username" placeholder="Username" required><br><br>

        <label class="label" for="email">E-Mail</label>
        <input class="input" type="text" id="email" name="email" placeholder="E-Mail" required><br><br>

        <label class="label" for="pswd">Password</label>
        <input class="input" type="password" id="pswd" name="pswd" placeholder="Password" required><br><br>

        <label class="label">Gender</label>

        <div>
            <input class="checkbox" type="radio" id="women" name="gender[]" value="Women">
            <label class="checktext" for="women">Women</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="man" name="gender[]" value="Man">
            <label class="checktext" for="man">Male</label>
        </div>

        <label class="label">Select your taste:</label>

        <div>
            <input class="checkbox" type="radio" id="Floral" name="taste[]" value="Floral">
            <label class="checktext" for="Floral">Floral</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="Aromatic" name="taste[]" value="Aromatic">
            <label class="checktext" for="Aromatic">Aromatic</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="Amber" name="taste[]" value="Amber">
            <label class="checktext" for="Amber">Amber</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="Chypre" name="taste[]" value="Chypre">
            <label class="checktext" for="Chypre">Chypre</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="Citrus" name="taste[]" value="Citrus">
            <label class="checktext" for="Citrus">Citrus</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="Leather" name="taste[]" value="Leather">
            <label class="checktext" for="Leather">Leather</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="Woody" name="taste[]" value="Woody">
            <label class="checktext" for="Woody">Woody</label>
        </div>

        <button id="sign_up" type="submit" onclick="createUser()">
            Sign up
        </button>
        <br>

        <p id="response"></p>
    </div>

    <script>
        function createUser() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("response").innerHTML = this.responseText;
                    window.location.replace("index.php");
                } else {
                    document.getElementById("response").innerHTML = this.responseText;
                }
            };

            var first_name = document.getElementById('first_name').value;
            var last_name = document.getElementById('last_name').value;
            var birth_date = document.getElementById('birth_date').value;
            var email = document.getElementById('email').value;
            var username = document.getElementById('username').value;
            var password = document.getElementById('pswd').value;

            var gender;
            if (document.getElementById('women').checked) {
                gender = "Women";
            } else if (document.getElementById('man').checked) {
                gender = "Man";
            }

            var fav_taste;
            if (document.getElementById('Floral').checked) {
                fav_taste = "Floral";
            } else if (document.getElementById('Aromatic').checked) {
                fav_taste = "Aromatic";
            } else if (document.getElementById('Amber').checked) {
                fav_taste = "Amber";
            } else if (document.getElementById('Chypre').checked) {
                fav_taste = "Chypre";
            } else if (document.getElementById('Citrus').checked) {
                fav_taste = "Citrus";
            } else if (document.getElementById('Leather').checked) {
                fav_taste = "Leather";
            } else if (document.getElementById('Woody').checked) {
                fav_taste = "Woody";
            }

            xhttp.open("POST", "API/user/create.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("first_name=" + first_name + "&last_name=" + last_name + "&birth_date=" + birth_date +
                "&email=" + email + "&username=" + username + "&pswd=" + password +
                "&gender=" + gender + "&taste=" + fav_taste);
        }
    </script>

</main>
</body>
</html>