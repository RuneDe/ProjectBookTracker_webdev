<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js"></script>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <div id="contentWrapper">
    <?php if (isset($_SESSION['username'])) { ?>
        <p>Welcome <?php echo $_SESSION['username']; ?></p>
    <?php } else { ?>
        <p>You are not logged in. Please <a href="login.php">log in</a> or <a href="register.php">register</a> to view your profile.</p>
    <?php } ?>
    </div>
</body>
</html>
