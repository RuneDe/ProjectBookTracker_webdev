<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <div id="contentWrapper">
        <!-- inhoud van de Home-pagina -->
        <p1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat eligendi tenetur facere debitis adipisci nulla repudiandae sunt possimus nesciunt quas aspernatur nisi sit eum, vero quibusdam ut nobis numquam nam.</p1>
    </div>
<div class="container login">
    <?php if (!isset($_SESSION['username'])) { ?>
        <p>You are not logged in. Please <a href="Login.php">log in</a> or <a href="Register.php">register</a> to view your profile.</p>
    <?php } ?>
</div>
</body>
</html>
