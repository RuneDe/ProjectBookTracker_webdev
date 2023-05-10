<?php

$errors = array(); // maak een array aan voor foutmeldingen

// open de databaseverbinding
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booktracker_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// verander het emailadres van de gebruiker
if (isset($_POST['change_email'])) {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : $_POST['current_email'];

    if (empty($email)) {
        array_push($errors, "Email is required");
    }

    // check het aantal foutmeldingen, voer dan de emailverandering uit
    if (count($errors) == 0) {
        $username = $_SESSION['username'];
        $stmt = mysqli_prepare($conn, "UPDATE users SET email=? WHERE username=?");
        mysqli_stmt_bind_param($stmt, "ss", $email, $username);
        mysqli_stmt_execute($stmt);
        $_SESSION['email'] = $email;
        header('location: settings.php');
        exit();
    }
}

// verander het wachtwoord van de gebruiker
if (isset($_POST['change_password'])) {
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if (empty($current_password)) {
        array_push($errors, "Current password is required");
    }
    if (empty($new_password)) {
        array_push($errors, "New password is required");
    }
    if ($new_password != $confirm_password) {
        array_push($errors, "The two passwords do not match");
    }

    // check het aantal foutmeldingen, voer dan de wachtwoordverandering uit
    if (count($errors) == 0) {
        $username = $_SESSION['username'];
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username=?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if (password_verify($current_password, $user['password'])) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, "UPDATE users SET password=? WHERE username=?");
            mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $username);
            mysqli_stmt_execute($stmt);
            header('location: settings.php');
            exit();
        } else {
            array_push($errors, "Current password is incorrect");
        }
    }
}

// verwijder het account van de gebruiker
if (isset($_POST['delete_account'])) {
    $username = $_SESSION['username'];
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    session_destroy();
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js"></script>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <div id="contentWrapper">
    <form action="settings.php" method="post">
    <div class="container">
    <h1>Settings</h1>
    <p>Change your email or password.</p>
    <hr>

        <label for="email"><b>Email</b></label><br>
        <input type="text" placeholder="Enter Email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : (isset($_SESSION['email']) ? $_SESSION['email'] : ''); ?>" required ><br>
        <input type="hidden" name="current_email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
        <button type="submit" class="loginbtn" name='change_email'>Change Email</button>
    </div>
    </form>

    <form action="settings.php" method="post">
    <div class="container">
        <label for="current_password"><b>Current Password</b></label><br>
        <input type="password" placeholder="Enter Current Password" name="current_password" id="current_password" autocomplete="new-password" required><br>

        <label for="new_password"><b>New Password</b></label><br>
        <input type="password" placeholder="Enter New Password" name="new_password" id="new_password" autocomplete="new-password" required><br>

        <label for="confirm_password"><b>Confirm New Password</b></label><br>
        <input type="password" placeholder="Confirm New Password" name="confirm_password" id="confirm_password" autocomplete="new-password" required><br>
        <button type="submit" class="loginbtn" name='change_password'>Change Password</button>
    </div>
    </form>

    <form action="settings.php" method="post">
    <div class="container">
        <p>Are you sure you want to delete your account?</p>
        <button type="submit" class="loginbtn" name='delete_account'>Delete Account</button>
    </div>
    </form>

    <?php if (count($errors) > 0) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
    <?php endif ?>

    </div>
</body>
</html>