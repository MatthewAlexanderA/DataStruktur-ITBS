<?php
function mergeSort($arr){
    $n = count($arr);
    if($n <= 1) return $arr;
    $mid = floor($n/2);
    $left = mergeSort(array_slice($arr, 0, $mid));
    $right = mergeSort(array_slice($arr, $mid));
    return merge($left, $right);
}

function merge($left, $right){
    $result = array();
    while(count($left) > 0 && count($right) > 0){
        if($left[0] <= $right[0]){
            $result[] = array_shift($left);
        } else{
            $result[] = array_shift($right);
        }
    }
    $result = array_merge($result, $left);
    $result = array_merge($result, $right);
    return $result;
}

// Usage
$arr = [38, 27, 43, 3, 9, 82, 10];
$sortedArr = mergeSort($arr);
print_r($sortedArr);


// Matthew Alexander Andriyanto
// 231232025
?>