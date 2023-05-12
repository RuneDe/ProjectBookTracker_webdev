<?php
// open de databaseverbinding
$db = mysqli_connect('localhost', 'root', '', 'booktracker_db');

// haal alle boeken op uit de database
$stmt = mysqli_prepare($db, "SELECT * FROM browse_book");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result) {
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $books = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tracker Browse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js"></script>
</head>
<body>
<?php include_once("navbar.php"); ?>
    <div id="contentWrapper">
    <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') : ?>
        <button onclick="openModal()">Add Book</button>
    <?php endif; ?>

    <div id="bookModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="add_browse_books.php" method="post" enctype="multipart/form-data">
                <label for="title"><b>Title</b></label><br>
                <input type="text" placeholder="Enter Title" name="title" required><br>

                <label for="cover"><b>Cover</b></label><br>
                <input type="file" name="cover" accept="image" required><br>

                <label for="synopsis"><b>Synopsis</b></label><br>
                <textarea placeholder="Enter Synopsis" name="synopsis" required></textarea><br>

                <label for="author"><b>Author</b></label><br>
                <input type="text" placeholder="Enter Author" name="author" required><br>

                <button type="submit" class="loginbtn" name='add_book'>Add Book</button>
            </form>
        </div>
    </div>

    <div class="book-container">
    <?php foreach ($books as $book) : ?>
        <div class="book">
            <div class="titleWrapper">
                <h3><?php echo $book['title']; ?></h3>
             </div>
            <div class="bookWrapper">
                <div class="imageWrapper">
                    <img src="Covers/<?php echo str_replace(' ', '_', $book['title']) . '.jpg'; ?>" alt="<?php echo $book['title']; ?> Cover">            
                </div>
                <div class="textWrapper">
                    <p><?php echo nl2br(stripslashes($book['synopsis'])); ?></p>   
                </div>
            </div>     
            <div class="authorWrapper">  
                <p>Author: <?php echo $book['author']; ?></p>
            </div> 
        </div>
    <?php endforeach; ?>
</div>



    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("bookModal");

        // Get the button that opens the modal
        var btn = document.getElementsByTagName("button")[0];

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>