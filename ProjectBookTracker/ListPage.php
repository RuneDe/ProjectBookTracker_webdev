<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    
    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts/script.js" type="module" defer></script>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <div id="contentWrapper">
    <h1>My library</h1>
	<button id="add-book-btn">Add book</button>
	<div id="book-list"></div>

	<div id="add-book-modal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<h2>Add book to your library</h2>
			<form id="add-book-form" method="POST" action="add_book.php">
				<label for="title">Title:</label><br>
				<input type="text" id="title" name="title"><br>
				<label for="author">Author:</label><br>
				<input type="text" id="author" name="author"><br>
				<label for="year">Year:</label><br>
				<input type="number" id="year" name="year"><br><br>
                <label for="pages">Pages:</label><br>
				<input type="number" id="pages" name="pages"><br><br>
                <label for="score">Score:</label><br>
				<input type="number" id="score" name="score"><br><br>
                <label for="comment">Comment:</label><br>
				<input type="text" id="comment" name="comment"><br><br>
				<input type="submit" value="Add book to libray">
			</form>
		</div>
	</div>
    </div>
</body>
</html>