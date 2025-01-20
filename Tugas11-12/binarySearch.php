<?php
function binarySearch($arr, $target){
    $low = 0;
    $high = count($arr) - 1;
    while($low <= $high){
        $mid = floor(($low + $high) / 2);
        if($arr[$mid] == $target){
            return $mid;
        } elseif($arr[$mid] < $target){
            $low = $mid + 1;
        } else{
            $high = $mid - 1;
        }
    }
    return -1;
}

// Usage
echo "<br>Binary Search:<br>";
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9]; // Needs to be sorted
$target = 6;
$result = binarySearch($arr, $target);
echo "Target $target found at index: " . ($result !== -1 ? $result : "Not Found") . "<br>";

// Matthew Alexander Andriyanto
// 231232025
?>