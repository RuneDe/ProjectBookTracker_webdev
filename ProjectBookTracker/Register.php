<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="register.css">
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

    <form action="HomePage.php">
    <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

        <label for="email"><b>Email</b></label><br>
        <input type="text" placeholder="Enter Email" name="email" id="email" required><br>

        <label for="username"><b>Username</b></label><br>
        <input type="text" placeholder="Enter Username" name="username" id="username" required><br>

        <label for="psw"><b>Password</b></label><br>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required><br>

        <label for="psw-repeat"><b>Repeat Password</b></label><br>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required><br>
        <hr>

        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="Login.php">Login</a>.</p>
    </div>
 </form>

 <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['psw'];
    $password_repeat = $_POST['psw-repeat'];

    // Connect to database
    $servername = "localhost";
    $username_db = "your_username";
    $password_db = "your_password";
    $dbname = "booktracker_db";
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email or username already exist
    $sql = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Email or username already exists.";
        exit();
    }

    // Check if password and repeat password match
    if ($password != $password_repeat) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        echo "User created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
</body>
</html>