// Add event listener to "Add book" form
document.querySelector("#add-book-form").addEventListener("submit", async (event) => {
  event.preventDefault(); // Prevent default form behavior
  const formData = new FormData(event.target); // Get form data
  try {
    const response = await fetch("add_book.php", {
      method: "POST",
      body: formData,
    });
    if (!response.ok) {
      throw new Error("Response not OK");
    }
    window.location.href = "ListPage.php"; // Redirect to list page on successful book addition
  } catch (error) {
    console.error(error);
    // Handle error
  }
});

// Find "Add book" button and modal form
const addBookBtn = document.querySelector("#add-book-btn");
const addBookModal = document.querySelector("#add-book-modal");

// Find "Close" button to close modal form
const closeBtn = document.querySelector(".close");

// Add click event listener to "Add book" button
addBookBtn.addEventListener("click", () => {
  addBookModal.style.display = "block";
});

// Add click event listener to "Close" button
closeBtn.addEventListener("click", () => {
  addBookModal.style.display = "none";
});

// Add click event listener to window to close modal form when clicked outside of it
window.addEventListener("click", (event) => {
  if (event.target == addBookModal) {
    addBookModal.style.display = "none";
  }
});

// Find element that contains the book list
const bookList = document.querySelector("#book-list");

// Function to add book to list
function addBookToList(book) {
  // Create new row for book
  const row = document.createElement("tr");
  row.setAttribute("data-id", book.id); // Add data attribute for book ID

  // Add book data to row
  row.innerHTML = `
    <td>${book.title}</td>
    <td>${book.author}</td>
    <td>${book.year}</td>
    <td>${book.pages}</td>
    <td>${book.score}</td>
    <td>${book.comment}</td>
    <td>
      <button class="edit-btn"><i class="fas fa-edit"></i></button>
      <button class="delete-btn"><i class="fas fa-trash"></i></button>
    </td>
  `;

  // Add row to list
  bookList.appendChild(row);

  // Find edit and delete buttons in current row
  const editBtn = row.querySelector(".edit-btn");
  const deleteBtn = row.querySelector(".delete-btn");

  // Add click event listener to edit button
  editBtn.addEventListener("click", async () => {
    try {
      // Find book ID by climbing up the row
      const bookId = row.dataset.id;

      // Fetch book data from server and fill in form fields
      const response = await fetch(`get_book.php?id=${bookId}`);
      if (!response.ok) {
        throw new Error("Response not OK");
      }
      const book = await response.json();
      document.querySelector("#book-id").value = book.id;
      document.querySelector("#title").value = book.title;
      document.querySelector("#author").value = book.author;
      document.querySelector("#year").value = book.year;
      document.querySelector("#pages").value = book.pages;
      document.querySelector("#score").value = book.score;
      document.querySelector("#comment").value = book.comment;

      // Show edit book modal
      document.querySelector("#edit-book-modal").style.display = "block";
    } catch (error) {
      console.error(error);
      // Handle error
    }
  });

  // Add click event listener to delete button
  deleteBtn.addEventListener("click", async () => {
    try {
      // Find book ID by climbing up the row
      const bookId = row.dataset.id;

      // Confirm book deletion with user
      if (confirm("Are you sure you want to delete this book?")) {
        // Delete book from server using fetch request
        const response = await fetch("delete_book.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ id: bookId }),
        });
        if (!response.ok) {
          throw new Error("Response not OK");
        }

        // Remove row from table
        row.remove();
      }
    } catch (error) {
      console.error(error);
      // Handle error
    }
  });
}

// Function to load book list on page load
async function loadBookList() {
  try {
    // Fetch book list from server
    const response = await fetch("get_books.php");
    if (!response.ok) {
      throw new Error("Response not OK");
    }
    const books = await response.json();

    // Add each book to the list
    books.forEach((book) => {
      addBookToList(book);
    });
  } catch (error) {
    console.error(error);
    // Handle error
  }
}

// Load book list on page load
window.addEventListener("load", loadBookList);

// Add event listener to "Edit book" form
document.querySelector("#edit-book-form").addEventListener("submit", async (event) => {
  event.preventDefault(); // Prevent default form behavior
  const formData = new FormData(event.target); // Get form data

  // Find book ID from form data
  // Find book ID from clicked row
const row = event.target.closest("tr");
const bookId = row.dataset.id;

// Set book ID in hidden input field
document.querySelector("#book-id").value = bookId;

  try { 
    const response = await fetch("edit_book.php", {
      method: "POST",
      body: formData,
    });
    if (!response.ok) {
      throw new Error("Response not OK");
    }
    console.log(formData);
    window.location.href = "ListPage.php"; // Redirect to list page on successful book edit
  } catch (error) {
    console.error(error);
    // Handle error
  }
});

// Add event listener to "Close" button in "Edit book" modal
document.querySelector("#edit-book-modal .close").addEventListener("click", () => {
  document.querySelector("#edit-book-modal").style.display = "none";
});