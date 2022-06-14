<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="Signup.css" type="text/css" />
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
    <form class="sign-up-form" action = "API/user/create.php" method="POST">
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
            <input class="checkbox" type="radio" id="Feminine" name="gender[]" value="Feminine">
            <label class="checktext" for="Feminine">Feminine</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="male" name="gender[]" value="Male">
            <label class="checktext" for="male">Male</label>
        </div>

        <label class="label">Select your taste:</label>

        <div>
            <input class="checkbox" type="radio" id="Floral" name="taste[]" value="Floral">
            <label class="checktext" for="Floral">Floral</label>
        </div>

        <div>
            <input class="checkbox" type="radio" id="Aromatic"name="taste[]" value="Aromatic">
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

        <button id = "sign_up">
            Sign up
        </button>
    </form>

    <?php
       $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       if(strpos($fullUrl, "signup=email") == true) {
           echo '<p class="error"> This email is already used!</p>';
          exit();
     }
      elseif (strpos($fullUrl, "signup=username") == true) {
         echo '<p class="error"> This username is already used!</p>';
         exit();
     }
      elseif(strpos($fullUrl, "signup=format") == true) {
          echo '<p class="error"> Format of email is wrong!</p>';
          exit();
     }
       elseif(strpos($fullUrl, "signup=date") == true) {
        echo '<p class="error"> Format of date is wrong!</p>';
          exit();
      }
     ?>
</main>
</body>
</html>