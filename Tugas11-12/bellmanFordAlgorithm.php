<?php
function bellmanFord($graph, $start){
    $n = count($graph);
    $distance = array_fill(0, $n, INF);
    $distance[$start] = 0;
    for($i = 0; $i < $n - 1; $i++){
        for($j = 0; $j < $n; $j++){
            foreach($graph[$j] as $neighbor => $weight){
                $distance[$neighbor] = min($distance[$neighbor], $distance[$j] + $weight);
            }
        }
    }
    return $distance;
}

// Usage
echo "<br>Bellman Ford Algorithm:<br>";
$graph = [
    0 => [1 => 6, 2 => 7],
    1 => [2 => 8, 3 => 5, 4 => -4],
    2 => [3 => -3, 4 => 9],
    3 => [1 => -2],
    4 => [0 => 2, 3 => 7]
];
$start = 0;
$result = bellmanFord($graph, $start);
echo "Shortest distances from node $start:<br>";
print_r($result);

// Matthew Alexander Andriyanto
// 231232025
?>