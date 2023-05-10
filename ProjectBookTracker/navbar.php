<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booktracker</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    $username = 'Profile';
} else {
    $username = $_SESSION['username'];
}
?>
<nav>
    <ul>
        <li><a href="navbar.php?request=HomePage">Home</a></li>
        <li><a href="navbar.php?request=ListPage">List</a></li>
        <li><a href="navbar.php?request=BrowsePage">Browse</a></li>
        <li><a href="navbar.php?request=ProfilePage"><?php echo $username; ?></a></li>
        <div class="dropdown">
            <button class="settingsbtn"><i class="fas fa-cog"></i></button>
            <div class="dropdown-content">
                <?php if (isset($_SESSION['username'])) { ?>
                    <li><a href="navbar.php?request=Logout">Logout</a></li><br>
                    <li><a href="navbar.php?request=SettingsPage">Settings</a></li>
                <?php } else { ?>
                    <li><a href="navbar.php?request=Register">Register</a></li><br>
                    <li><a href="navbar.php?request=Login">Login</a></li>
                <?php } ?>
            </div>
        </div>
    </ul>
</nav>
<div id="contentWrapper">
        <?php
            if(isset($_GET["request"]))
                include_once($_GET["request"].".php");
            else
                include_once("HomePage.php");
        ?>
    </div>
</body>
</html>
