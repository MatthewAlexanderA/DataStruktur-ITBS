<?php
function linearSearch($arr, $target){
    for($i = 0; $i < count($arr); $i++){
        if($arr[$i] == $target){
            return $i;
        }
    }
    return -1;
}

// usage
echo "Linear Search:<br>";
$arr = [1, 3, 5, 7, 9];
$target = 5;
$result = linearSearch($arr, $target);
echo "Target $target found at index: " . ($result !== -1 ? $result : "Not Found") . "<br>";

// Matthew Alexander Andriyanto
// 231232025
?>