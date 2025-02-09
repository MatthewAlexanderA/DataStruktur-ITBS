<?php 

class HashTable {
    private $table;
    private $size;

    public function __construct($size) {
        $this->size = $size;
        $this->table = array_fill(0, $size, []);
    }

    private function hashFunction($key) {
        return crc32($key) % $this->size;
    }

    public function insert($key, $value) {
        $index = $this->hashFunction($key);
        $this->table[$index][] = ['key' => $key, 'value' => $value];
    }

    public function search($key) {
        $index = $this->hashFunction($key);
        foreach ($this->table[$index] as $item) {
            if ($item['key'] === $key) {
                return $item['value'];
            }
        }
        return null;
    }

    public function delete($key) {
        $index = $this->hashFunction($key);
        foreach ($this->table[$index] as $i => $item) {
            if ($item['key'] === $key) {
                array_splice($this->table[$index], $i, 1);
                return true;
            }
        }
        return false;
    }

    public function printTable() {
        foreach ($this->table as $index => $bucket) {
            echo "Bucket $index: ";
            foreach ($bucket as $item) {
                echo "[" . $item['key'] . " => " . $item['value'] . "] ";
            }
            echo "<br>";
        }
    }
}

// Usage
$hashTable = new HashTable(10);

$hashTable->insert("name", "John Doe");
$hashTable->insert("age", 30);
$hashTable->insert("city", "New York");

$hashTable->printTable();

echo "<br>Search for 'age': " . $hashTable->search("age") . "<br><br>"; 

$hashTable->delete("age");
$hashTable->printTable();

// Matthew Alexander Andriyanto
// 231232025
?>