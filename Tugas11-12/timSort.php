<?php
function timSort($arr){
    $min_run = 32;
    $n = count($arr);
    for($i = 0; $i < $n; $i += $min_run){
        $end = min($i + $min_run, $n);
        insertionSort($arr, $i, $end);
    }
    $size = $min_run;
    while($size < $n){
        for($i = 0; $i < $n; $i += $size * 2){
            $mid = min($i + $size, $n);
            $end = min($i + $size * 2, $n);
            merge($arr, $i, $mid, $end);
        }
        $size *= 2;
    }
    return $arr;
}

function insertionSort(&$arr, $start, $end){
    for($i = $start + 1; $i < $end; $i++){
        $temp = $arr[$i];
        $j = $i - 1;
        while($j >= $start && $arr[$j] > $temp){
            $arr[$j + 1] = $arr[$j];
            $j--;
        }
        $arr[$j + 1] = $temp;
    }
}

function merge(&$arr, $start, $mid, $end){
    $left = array_slice($arr, $start, $mid - $start);
    $right = array_slice($arr, $mid, $end - $mid);

    $i = $j = 0;
    $k = $start;

    while($i < count($left) && $j < count($right)){
        if($left[$i] <= $right[$j]){
            $arr[$k++] = $left[$i++];
        } else {
            $arr[$k++] = $right[$j++];
        }
    }

    while($i < count($left)){
        $arr[$k++] = $left[$i++];
    }

    while($j < count($right)){
        $arr[$k++] = $right[$j++];
    }
}

// Usage
$arr = [5, 21, 7, 23, 19, 1, 15, 13, 3, 17];
$sortedArr = timSort($arr);
print_r($sortedArr);

// Matthew Alexander Andriyanto
// 231232025
?>