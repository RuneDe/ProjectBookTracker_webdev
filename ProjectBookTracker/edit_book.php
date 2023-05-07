<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booktracker_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$sql = "UPDATE books SET ";
$params = array();
if (!empty($_POST["title"])) {
  $sql .= "title=?, ";
  $params[] = $_POST["title"];
}
if (!empty($_POST["author"])) {
  $sql .= "author=?, ";
  $params[] = $_POST["author"];
}
if (!empty($_POST["year"])) {
  $sql .= "year=?, ";
  $params[] = $_POST["year"];
}
if (!empty($_POST["pages"])) {
  $sql .= "pages=?, ";
  $params[] = $_POST["pages"];
}
if (!empty($_POST["score"])) {
  $sql .= "score=?, ";
  $params[] = $_POST["score"];
}
if (!empty($_POST["comment"])) {
  $sql .= "comment=?, ";
  $params[] = $_POST["comment"];
}
$sql = rtrim($sql, ", ");
$sql .= " WHERE id=?";
$params[] = $_POST["book-id"];

$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat("s", count($params)), ...$params);

// Execute SQL statement
if ($stmt->execute()) {
  echo "Book updated successfully";
} else {
  echo "Error updating book: " . $conn->error;
}

// Close database connection
$stmt->close();
$conn->close();
?>