<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="styles/style.css">
    
    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts/script.js" type="module" defer></script>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <div id="contentWrapper">
    <h1>My library</h1>
	<button id="add-book-btn">Add book</button>
	<table id="book-table">
			<thead>
				<tr>
				<th>Title</th>
				<th>Author</th>
				<th>Year</th>
				<th>Pages</th>
				<th>Score</th>
				<th>Comment</th>
				<th>Actions</th>
				</tr>
			</thead>
			<tbody id="book-list">
			</tbody>
		</table>

	<div id="add-book-modal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<h2>Add book to your library</h2>
			<form id="add-book-form" method="POST" action="add_book.php">
				<label for="title">Title:</label>
				<input type="text" id="title" name="title"><br>
				<label for="author">Author:</label>
				<input type="text" id="author" name="author"><br>
				<label for="year">Year:</label>
				<input type="number" id="year" name="year"><br><br>
                <label for="pages">Pages:</label>
				<input type="number" id="pages" name="pages"><br><br>
                <label for="score">Score:</label>
				<input type="number" id="score" name="score"><br><br>
                <label for="comment">Comment:</label>
				<input type="text" id="comment" name="comment"><br><br>
				<input type="submit" value="Add book to libray">
			</form>
		</div>
		
	</div>

	<!-- Modal voor het bewerken van een boek -->
<div id="edit-book-modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Edit Book</h2>
    <form id="edit-book-form">
      <input type="hidden" id="book-id" name="book-id" value="">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" value=""><br>
      <label for="author">Author:</label>
      <input type="text" id="author" name="author" value=""><br>
      <label for="year">Year:</label>
      <input type="number" id="year" name="year" value=""><br><br>
      <label for="pages">Pages:</label>
      <input type="number" id="pages" name="pages" value=""><br><br>
      <label for="score">Score:</label>
      <input type="number" id="score" name="score" value=""><br><br>
      <label for="comment">Comment:</label>
      <input type="text" id="comment" name="comment"><br><br>
      <button type="submit" id="save-changes-btn">Save Changes</button>
    </form>
  </div>
</div>

    </div>
</body>
</html>




