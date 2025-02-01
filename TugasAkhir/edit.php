<?php
require 'includes/db.php';
require 'includes/Book.php';

$book = new Book($conn);

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

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
        // Upload new picture if provided
        if (!empty($picture)) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
        } else {
            // Keep the existing picture
            $existing_book = $book->read();
            $picture = $existing_book['picture'];
        }

        // Update book in database
        $book->update($id, $title, $picture, $author, $total_pages, $publish_year);
        header("Location: index.php");
        exit();
    }
}

$book_data = $book->read();
$current_book = null;
foreach ($book_data as $b) {
    if ($b['id'] == $id) {
        $current_book = $b;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
        <h1>Edit Book</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="edit.php?id=<?= $id ?>" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($current_book['title']) ?>" required>

            <label for="picture">Picture:</label>
            <input type="file" name="picture" id="picture" onchange="previewImage(event)">
            <small>Current: <?= htmlspecialchars($current_book['picture']) ?></small>
            <img id="image-preview" src="images/<?= htmlspecialchars($current_book['picture']) ?>" alt="Image Preview" style="max-width: 100px; margin-top: 10px;">

            <label for="author">Author:</label>
            <input type="text" name="author" id="author" value="<?= htmlspecialchars($current_book['author']) ?>" required>

            <label for="total_pages">Total Pages:</label>
            <input type="number" name="total_pages" id="total_pages" value="<?= htmlspecialchars($current_book['total_pages']) ?>" required>

            <label for="publish_year">Publish Year:</label>
            <input type="number" name="publish_year" id="publish_year" value="<?= htmlspecialchars($current_book['publish_year']) ?>" required>

            <button type="submit" class="btn">Update Book</button>
            <a href="index.php" class="btn back">Back</a>
        </form>
    </div>
</body>
</html>