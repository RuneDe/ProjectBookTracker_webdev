<?php
session_start(); // start de sessie

$errors = array(); // maak een array aan voor foutmeldingen

// open de databaseverbinding
$db = mysqli_connect('localhost', 'root', '', 'booktracker_db');

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // check het aantal foutmeldingen, voer dan de inlogpoging uit
    if (count($errors) == 0) {
        
        // gebruik een prepared statement om SQL-injecties te voorkomen
        $stmt = mysqli_prepare($db, "SELECT * FROM users WHERE username=?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1 && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('location: ProfilePage.php');
            exit();
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

// voorkom dat ingelogde gebruikers de inlogpagina zien
if (isset($_SESSION['username'])) {
    header('location: ProfilePage.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js"></script>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <div id="contentWrapper">
    <form action="login.php" method="post">
    <div class="container">
    <h1>Login</h1>
    <p>Please fill in this form to login.</p>
    <hr>

        <label for="username"><b>Username</b></label><br>
        <input type="text" placeholder="Enter Username" name="username" id="username" required ><br>

        <label for="password"><b>Password</b></label><br>
        <input type="password" placeholder="Enter Password" name="password" id="password" required><br>

        <button type="submit" class="loginbtn" name='login_user'>Login</button>
    </div>
    <div class="container login">
        <p>Not yet a member? <a href="register.php">Sign up</a>.</p>
    </div>
    </div>

    

    <?php if (count($errors) > 0) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
    <?php endif ?>

</body>
</html>