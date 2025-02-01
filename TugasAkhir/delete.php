<?php
require 'includes/db.php';
require 'includes/Book.php';

$book = new Book($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $book->delete($id);
}

header("Location: index.php");
exit();
?>