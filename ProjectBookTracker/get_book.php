<?php
// Get book ID from query parameter
$id = $_GET["id"];

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booktracker_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve book from database
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
$stmt->close();

// Close database connection
$conn->close();

// Return book as JSON
header("Content-Type: application/json");
echo json_encode($book);
?>