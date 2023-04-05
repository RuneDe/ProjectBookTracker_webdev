<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Login</title>
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
        <li><a href="ProfilePage.php">Profile</a></li>
        <div class="dropdown">
            <button class="settingsbtn"><i class="fas fa-cog"></i></button>
            <div class="dropdown-content">
                <li><a href="Register.php">Registreren</a></li>
                <li><a href="Login.php">Inloggen</a></li>
                <li><a href="Logout.php">Uitloggen</a></li>
                <li><a href="SettingsPage.php">Instellingen</a></li>
            </div>
        </div>
    </ul>
    </nav>

    <form method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" required>

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required>

        <input type="submit" name="login" value="Inloggen">
    </form>

    <?php
        // Verbinden met de database
        $db_host = 'localhost';
        $db_name = 'booktracker_db';
        $db_user = 'username';
        $db_pass = 'password';
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

        // Controleren of het formulier is ingediend
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        // Gebruikersinvoer controleren en opschonen
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // Query om de gebruiker op te halen uit de database
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        // Controleren of de gebruiker bestaat en het wachtwoord overeenkomt
        if ($user && password_verify($password, $user['password'])) {
            // Gebruiker ingelogd, sla sessievariabelen op en stuur door naar de startpagina
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        } else {
            // Foutief inloggegevens
            $login_error = "Ongeldige gebruikersnaam of wachtwoord!";
        }
        }
        ?>
</body>
</html>