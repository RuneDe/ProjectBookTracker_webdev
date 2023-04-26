var bookList = [];

function addBookToList(book) {
    bookList.push(book);
    showBookList();
}

function showBookList() {
    var bookListHtml = "";

    for (var i = 0; i < bookList.length; i++) {
        bookListHtml += "<p>" + bookList[i].title + "</p>";
        bookListHtml += "<p>by:  " + bookList[i].author + "</p>";
        bookListHtml += "<p>Released in: " + bookList[i].year + "</p>";
        bookListHtml += "<p>Pages: " + bookList[i].pages + "</p>";
        bookListHtml += "<p>Score: " + bookList[i].score + "</p>";
        bookListHtml += "<p>Comment: " + bookList[i].comment + "</p>";
    }

    $("#book-list").html(bookListHtml);
}

$(document).ready(function() {
    $("#add-book-btn").click(function() {
        $("#add-book-modal").show();
    });

    $(".close").click(function() {
        $("#add-book-modal").hide();
    });

    $("#add-book-form").submit(function(event) {
        event.preventDefault();

        var title = $("#title").val();
        var author = $("#author").val();
        var year = $("#year").val();
        var pages = $("#pages").val();
        var score = $("#score").val();
        var comment = $("#comment").val();

        var book = {title: title, author: author, year: year, pages: pages, score: score, comment: comment};

        // Send book data to server
        $.ajax({
            type: "POST",
            url: "add_book.php",
            data: book,
            success: function(data) {
                console.log("Book added successfully!");
            },
            error: function() {
                console.log("Error adding book!");
            }
        });

        addBookToList(book);

        $("#add-book-modal").hide();
    });
});
