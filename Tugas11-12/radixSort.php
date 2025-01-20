<?php
function radixSort($arr){
    $max = max($arr);
    $exp = 1;
    while(floor($max/$exp) > 0){
        $bucket = array_fill(0, 10, array());
        foreach($arr as $value){
            $bucket[floor($value/$exp) % 10][] = $value;
        }
        $arr = array();
        foreach($bucket as $values){
            $arr = array_merge($arr, $values);
        }
        $exp *= 10;
    }
    return $arr;
}

// Usage
$arr = [170, 45, 75, 90, 802, 24, 2, 66];
$sortedArr = radixSort($arr);
print_r($sortedArr);


// Matthew Alexander Andriyanto
// 231232025
?>