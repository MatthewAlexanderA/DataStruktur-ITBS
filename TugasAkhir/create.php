<?php
require 'includes/db.php';
require 'includes/Book.php';

$book = new Book($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $picture = $_FILES['picture']['name'];
    $author = $_POST['author'];
    $total_pages = $_POST['total_pages'];
    $publish_year = $_POST['publish_year'];

    // Validate input
    if (empty($title) || empty($author) || empty($total_pages) || empty($publish_year)) {
        $error = "All fields are required!";
    } else {
        // Upload picture
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);

        // Add book to database
        $book->create($title, $picture, $author, $total_pages, $publish_year);
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('image-preview');

            reader.onload = function() {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h1>Add New Book</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="create.php" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="picture">Picture:</label>
            <input type="file" name="picture" id="picture" onchange="previewImage(event)" required>
            <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 100px; margin-top: 10px;">

            <label for="author">Author:</label>
            <input type="text" name="author" id="author" required>

            <label for="total_pages">Total Pages:</label>
            <input type="number" name="total_pages" id="total_pages" required>

            <label for="publish_year">Publish Year:</label>
            <input type="number" name="publish_year" id="publish_year" required>

            <button type="submit" class="btn">Add Book</button>
            <a href="index.php" class="btn back">Back</a>
        </form>
    </div>
</body>
</html>