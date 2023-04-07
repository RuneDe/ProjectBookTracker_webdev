<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="HomePage.php">Home</a></li>
        <li><a href="ListPage.php">List</a></li>
        <li><a href="BrowsePage.php">Browse</a></li>
        <li><a href="ProfilePage.php"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Profile'; ?></a></li>
        <div class="dropdown">
            <button class="settingsbtn"><i class="fas fa-cog"></i></button>
            <div class="dropdown-content">
                <?php if (isset($_SESSION['username'])) { ?>
                    <li><a href="Logout.php">Logout</a></li>
                    <li><a href="SettingsPage.php">Settings</a></li>
                <?php } else { ?>
                    <li><a href="Register.php">Register</a></li>
                    <li><a href="Login.php">Login</a></li>
                <?php } ?>
            </div>
        </div>
    </ul>
</nav>
</body>
</html>
