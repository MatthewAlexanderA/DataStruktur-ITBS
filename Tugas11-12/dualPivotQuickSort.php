<?php
function dualPivotQuickSort($arr){
    if(count($arr) <= 1){
        return $arr;
    }
    $pivot1 = $arr[0];
    $pivot2 = $arr[count($arr) - 1];
    $less = array();
    $equal1 = array();
    $equal2 = array();
    $greater = array();
    for($i = 1; $i < count($arr) - 1; $i++){
        if($arr[$i] < $pivot1){
            $less[] = $arr[$i];
        } elseif($arr[$i] == $pivot1){
            $equal1[] = $arr[$i];
        } elseif($arr[$i] < $pivot2){
            $equal2[] = $arr[$i];
        } elseif($arr[$i] == $pivot2){
            $equal2[] = $arr[$i];
        } else{
            $greater[] = $arr[$i];
        }
    }
    $less = dualPivotQuickSort($less);
    $greater = dualPivotQuickSort($greater);
    return array_merge($less, $equal1, array($pivot1), $equal2, array($pivot2), $greater);
}

// Usage
$arr = [38, 27, 43, 3, 9, 82, 10];
$sortedArr = dualPivotQuickSort($arr);
print_r($sortedArr);

// Matthew Alexander Andriyanto
// 231232025
?>