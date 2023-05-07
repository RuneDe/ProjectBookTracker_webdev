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

// SQL query om alle gegevens uit de "books" tabel op te halen
$sql = "SELECT * FROM books";

// Uitvoeren van de query
$result = mysqli_query($conn, $sql);

// Array om de boeken in op te slaan
$books = array();

// Loop door alle rijen in het resultaat en voeg elk boek toe aan de array
while ($row = mysqli_fetch_assoc($result)) {
    array_push($books, $row);
}

// Retourneer de lijst van boeken als een JSON-object
echo json_encode($books);

// Sluiten van de databaseconnectie
mysqli_close($conn);
?>
