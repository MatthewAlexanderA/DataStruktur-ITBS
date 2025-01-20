<?php
function quickSort($arr){
    $n = count($arr);
    if($n <= 1) return $arr;
    $pivot = $arr[0];
    $smaller = array();
    $greater = array();
    for($i = 1; $i<$n; $i++){
        if($arr[$i] <= $pivot){
            $smaller[] = $arr[$i];
        } else{
            $greater[] = $arr[$i];
        }
    }
    $smaller = quickSort($smaller);
    $greater = quickSort($greater);
    return array_merge($smaller, array($pivot), $greater);
}

// Usage
$arr = [43, 65, 45, 1, 7, 23, 17];
$sortedArr = quickSort($arr);
print_r($sortedArr);


// Matthew Alexander Andriyanto
// 231232025
?>