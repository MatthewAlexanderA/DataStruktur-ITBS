<?php
session_start();
require 'includes/db.php';
require 'includes/Book.php';

$book = new Book($conn);

if (isset($_GET['sort'])) {
    $criteria = $_GET['sort'];
    $books = $book->read();
    $sorted_books = $book->sort($books, $criteria);

    // Store sorted books and sorting criteria in session
    $_SESSION['sorted_books'] = $sorted_books;
    $_SESSION['sort_criteria'] = $criteria;
}

// Redirect back to index.php with the sorting criteria
header("Location: index.php?sort=" . urlencode($_SESSION['sort_criteria']));
exit();
?>