<?php 
    include_once("navbar.php"); 

    // check if the user is logged in
    if(isset($_SESSION['username'])) {
        // if the user is logged in, display a logout button
        if(isset($_POST['logout'])) {
            // if the user clicked the logout button, destroy the session and redirect to the login page
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            // if the user is not trying to logout, display a welcome message and the logout button
            echo '<div id="contentWrapper">';
            echo '<h1>Welcome, ' . $_SESSION['username'] . '!</h1>';
            echo '<p>You are now logged in.</p>';
            echo '<form action="" method="post">';
            echo '<button type="submit" name="logout">Logout</button>';
            echo '</form>';
            echo '</div>';
        }
    } else {
        // if the user is not logged in, display a message and a link to the login page
        echo '<div id="contentWrapper">';
        echo '<h1>You are not logged in.</h1>';
        echo '<p>Please <a href="login.php">login</a> to access this page.</p>';
        echo '</div>';
    }
?>
