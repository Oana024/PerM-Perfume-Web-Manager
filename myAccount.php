<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
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
    <div>
        <h1>My Account</h1>

        <label class="label" for="first_name">First Name</label>
        <label class="input" for="first_name" id="first_name"></label>

        <label class="label" for="last_name">Last Name</label>
        <label class="input" for="last_name" id="last_name"></label>

        <label class="label" for="username">Username</label>
        <label class="input" for="username" id="username"></label>

        <label class="label" for="email">E-Mail</label>
        <label class="input" for="email" id="email"></label>

        <label class="label" for="birth_date">Birth Date</label>
        <label class="input" for="birth_date" id="birth_date"></label>

        <label class="label" for="gender">Gender</label>
        <label class="input" for="gender" id="gender"></label>

        <label class="label" for="favourite_taste">Favourite Taste</label>
        <label class="input" for="favourite_taste" id="fav_taste"></label>
    </div>
</main>

<script>
    window.onload = function getInfo(){
        var uid="<?php echo $_SESSION['userId']; ?>";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const myArray =  this.responseText.split(" ");
                document.getElementById("first_name").innerHTML = myArray[0];
                document.getElementById("last_name").innerHTML = myArray[1];
                document.getElementById("birth_date").innerHTML = myArray[2];
                document.getElementById("username").innerHTML = myArray[3];
                document.getElementById("email").innerHTML = myArray[4];
                document.getElementById("gender").innerHTML = myArray[5];
                document.getElementById("fav_taste").innerHTML = myArray[6];
            }
        };
        xhttp.open("GET", "API/user/read.php?id=" + uid, true);
        xhttp.send();
    }
</script>

</body>
</html>