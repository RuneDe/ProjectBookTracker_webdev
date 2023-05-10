<?php
session_start(); // start de sessie

// open de databaseverbinding
$db = mysqli_connect('localhost', 'root', '', 'booktracker_db');

// voeg een nieuw boek toe aan de database
if (isset($_POST['add_book'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $synopsis = mysqli_real_escape_string($db, $_POST['synopsis']);
    $author = mysqli_real_escape_string($db, $_POST['author']);

    // verplaats de cover image naar de juiste map
    $cover = 'C:/Users/Rune De Corte/Visual Studio Code/ProjectBookTracker/Covers/' . $_FILES['cover']['name'];
    move_uploaded_file($_FILES['cover']['tmp_name'], $cover);

    $stmt = mysqli_prepare($db, "INSERT INTO browse_book (title, synopsis, author) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $title, $synopsis, $author);
    mysqli_stmt_execute($stmt);

    header('location: BrowsePage.php');
    exit();
}
?>