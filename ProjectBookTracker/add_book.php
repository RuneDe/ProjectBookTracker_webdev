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

// Controleren of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verzamelen van de formuliervelden
    $title = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];
    $pages = $_POST["pages"];
    $score = $_POST["score"];
    $comment = $_POST["comment"];

    // SQL query om gegevens in te voeren in de "books" tabel
    $sql = "INSERT INTO books (title, author, year, pages, score, comment)
    VALUES ('$title', '$author', '$year', '$pages', '$score', '$comment')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Sluiten van de databaseconnectie
mysqli_close($conn);
?>