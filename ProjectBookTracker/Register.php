<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js"></script>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <div id="contentWrapper">
    <form action="Register.php" method="post"> 

    <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label><br>
    <input type="text" placeholder="Enter Email" name="email" id="email" autocomplete="off" required ><br>

    <label for="username"><b>Username</b></label><br>
    <input type="text" placeholder="Enter Username" name="username" id="username" autocomplete="off" required ><br>

    <label for="password_1"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password_1" id="password_1" autocomplete="off" required><br>

    <label for="password_2"><b>Repeat Password</b></label><br>
    <input type="password" placeholder="Repeat Password" name="password_2" id="password_2" autocomplete="off" required><br>
    <hr>

    <button type="submit" class="registerbtn" name="reg_user">Register</button>
</div>


 <?php


// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'booktracker_db');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt the password before saving in the database

  $query = "INSERT INTO users (username, email, password) 
    VALUES('$username', '$email', '$password')";
  mysqli_query($db, $query);
  $_SESSION['username'] = $username;
  $_SESSION['success'] = "You are now logged in";
  header('location: HomePage.php');
    exit();
  }
}
?>
<?php  if (count($errors) > 0) : ?>
  <div class="error">
  <?php foreach ($errors as $error) : ?>
    <p><?php echo $error ?></p>
  <?php endforeach ?>
  </div>
<?php  endif ?>
</body>
</html>
