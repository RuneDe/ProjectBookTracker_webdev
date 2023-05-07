<?php
// Get book ID from request body
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booktracker_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Delete book from database
$stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

// Close database connection
$conn->close();
?>
