<?php
session_start();
require 'includes/db.php';
require 'includes/Book.php';

$book = new Book($conn);

// Check if sorted books are in session
if (isset($_SESSION['sorted_books'])) {
    $books = $_SESSION['sorted_books'];
    unset($_SESSION['sorted_books']); // Clear session after use
} else {
    $books = $book->read();
}

// Get the current sorting criteria from the URL
$current_sort = isset($_GET['sort']) ? $_GET['sort'] : 'title';

// Pagination logic
$books_per_page = 25; // Number of books per page
$total_books = count($books); // Total number of books
$total_pages = ceil($total_books / $books_per_page); // Total pages needed

// Get the current page number from the URL
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) $current_page = 1;
if ($current_page > $total_pages) $current_page = $total_pages;

// Calculate the starting index for the current page
$start_index = ($current_page - 1) * $books_per_page;

// Get the books for the current page
$books_for_page = array_slice($books, $start_index, $books_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Book Management System</h1>
        <a href="create.php" class="btn">Add New Book</a>

        <!-- Sorting Filter -->
        <form method="GET" action="sort.php" class="sort-form">
            <label for="sort">Sort By:</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="title" <?= $current_sort === 'title' ? 'selected' : '' ?>>Title</option>
                <option value="author" <?= $current_sort === 'author' ? 'selected' : '' ?>>Author</option>
                <option value="publish_year" <?= $current_sort === 'publish_year' ? 'selected' : '' ?>>Publish Year</option>
                <option value="total_pages" <?= $current_sort === 'total_pages' ? 'selected' : '' ?>>Total Pages</option>
            </select>
        </form>

        <!-- Book List -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Picture</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publish Year</th>
                    <th>Total Pages</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Add a sequential ID counter
                $sequential_id = $start_index + 1;
                foreach ($books_for_page as $book):
                ?>
                    <tr>
                        <td><?= $sequential_id++ ?></td> <!-- Sequential ID -->
                        <td><img src="images/<?= htmlspecialchars($book['picture']) ?>" alt="<?= htmlspecialchars($book['title']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= htmlspecialchars($book['author']) ?></td>
                        <td><?= htmlspecialchars($book['publish_year']) ?></td>
                        <td><?= htmlspecialchars($book['total_pages']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $book['id'] ?>" class="btn">Edit</a>
                            <a href="delete.php?id=<?= $book['id'] ?>" class="btn delete" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($current_page > 1): ?>
                <a href="index.php?page=<?= $current_page - 1 ?>&sort=<?= $current_sort ?>" class="btn">Previous</a>
            <?php endif; ?>

            <span>Page <?= $current_page ?> of <?= $total_pages ?></span>

            <?php if ($current_page < $total_pages): ?>
                <a href="index.php?page=<?= $current_page + 1 ?>&sort=<?= $current_sort ?>" class="btn">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>