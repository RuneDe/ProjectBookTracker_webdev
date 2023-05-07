<?php
// Connectie maken met de database
$servername = "localhost";
$username = "root"; // Vul hier de gebruikersnaam van de database in
$password = ""; // Vul hier het wachtwoord van de database in
$dbname = "booktracker_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Controleren of de connectie werkt
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$title = $_POST["title"];
$author = $_POST["author"];
$year = $_POST["year"];
$pages = $_POST["pages"];
$score = $_POST["score"];
$comment = $_POST["comment"];

// Insert book record into database
$sql = "INSERT INTO books (title, author, year, pages, score, comment) VALUES ('$title', '$author', $year, $pages, $score, '$comment')";
if ($conn->query($sql) === TRUE) {
  echo "Book added successfully";
} else {
  echo "Error adding book: " . $conn->error;
}

// Close database connection
$conn->close();
?>