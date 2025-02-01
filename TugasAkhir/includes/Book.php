<?php
class Book {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Add a new book
    public function create($title, $picture, $author, $total_pages, $publish_year) {
        $stmt = $this->conn->prepare("INSERT INTO books (title, picture, author, total_pages, publish_year) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $picture, $author, $total_pages, $publish_year]);
    }

    // Get all books
    public function read() {
        $stmt = $this->conn->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a book
    public function update($id, $title, $picture, $author, $total_pages, $publish_year) {
        $stmt = $this->conn->prepare("UPDATE books SET title = ?, picture = ?, author = ?, total_pages = ?, publish_year = ? WHERE id = ?");
        $stmt->execute([$title, $picture, $author, $total_pages, $publish_year, $id]);
    }

    // Delete a book
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Sort books using bubble sort
    public function sort($books, $criteria) {
        $n = count($books);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($books[$j][$criteria] > $books[$j + 1][$criteria]) {
                    // Swap
                    $temp = $books[$j];
                    $books[$j] = $books[$j + 1];
                    $books[$j + 1] = $temp;
                }
            }
        }
        return $books;
    }
}
?>