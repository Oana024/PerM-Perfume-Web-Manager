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

        <a id='logout' href='API/user/logout.php'>Logout</a>
        <a id='acc' href='myAccount.php'>Account</a>

        <button id="help" onclick="window.location.href='Help.php'">
            Help
        </button>

        <button id="about" onclick="window.location.href='About.php'">
            About
        </button>

    </div>
</header>
<?php
include_once 'API/config/Database.php';

$database = new Database();
$db = $database->getConnection();

$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("s", $_SESSION['userId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>
<main id="main">
    <form>
        <h1>My Account</h1>

        <label class="label" for="first_name">First Name</label>
        <label class="input" for="first_name"><?php echo $row['first_name'] ?></label>

        <label class="label" for="last_name">Last Name</label>
        <label class="input" for="last_name"><?php echo $row['last_name'] ?></label>

        <label class="label" for="username">Username</label>
        <label class="input" for="username"><?php echo $row['username'] ?></label>

        <label class="label" for="email">E-Mail</label>
        <label class="input" for="email"><?php echo $row['email'] ?></label>

        <label class="label" for="birth_date">Birth Date</label>
        <label class="input" for="birth_date"><?php echo $row['birthdate'] ?></label>

        <label class="label" for="gender">Gender</label>
        <label class="input" for="gender"><?php echo $row['gender'] ?></label>

        <label class="label" for="favourite_taste">Favourite Taste</label>
        <label class="input" for="favourite_taste"><?php echo $row['favourite_taste'] ?></label>
    </form>
</main>

</body>
</html>