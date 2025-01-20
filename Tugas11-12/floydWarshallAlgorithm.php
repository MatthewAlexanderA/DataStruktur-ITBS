<?php
function floydWarshall($graph){
    $n = count($graph);
    for($k = 0; $k < $n; $k++){
        for($i = 0; $i < $n; $i++){
            for($j = 0; $j < $n; $j++){
                $graph[$i][$j] = min($graph[$i][$j], $graph[$i][$k] + $graph[$k][$j]);
            }
        }
    }
    return $graph;
}

// Usage
echo "<br>Floyd Warshall Algorithm:<br>";
$graph = [
    [0, 3, INF, INF],
    [2, 0, INF, INF],
    [INF, 7, 0, 1],
    [6, INF, INF, 0]
];
$result = floydWarshall($graph);
echo "All-pairs shortest path:<br>";
foreach ($result as $row) {
    echo implode("\t", $row) . "<br>";
}

// Matthew Alexander Andriyanto
// 231232025
?>