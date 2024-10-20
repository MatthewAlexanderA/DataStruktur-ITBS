<?php
class HashTable{
    private $table = [];
    public function put($key, $value){
        $hash = $this->hash($key);
        $this->table[$hash] = $value;
    }

    public function get($key){
        $hash = $this->hash($key);
        return $this->table[$hash] ?? null;
    }

    public function hash($key){
        return crc32($key) % 100; // Sederhana, menggunakan CRC32
    }
}

// Penggunaan
$hashTable = new HashTable();
$hashTable->put("name", "Matthew");
$hashTable->put("age", "19");
echo $hashTable->get("name") . "<br>";
?>