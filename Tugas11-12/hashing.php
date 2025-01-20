<?php
function hashing($arr, $target){
    $hashTable = array();
    foreach($arr as $value){
        $hashTable[hash('sha256', $value)] = $value;
    }
    return isset($hashTable[hash('sha256', $target)]) ? $hashTable[hash('sha256', $target)] : null;
}

// Usage
echo "<br>Hashing:<br>";
$arr = ['apple', 'banana', 'cherry'];
$target = 'banana';
$result = hashing($arr, $target);
echo "Target '$target' found: " . ($result ? $result : "Not Found") . "<br>";

// Matthew Alexander Andriyanto
// 231232025
?>