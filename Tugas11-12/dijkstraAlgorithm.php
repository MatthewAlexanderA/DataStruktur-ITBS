<?php
function dijkstra($graph, $start){
    $distance = array_fill(0, count($graph), INF);
    $distance[$start] = 0;
    $queue = array($start);
    while(!empty($queue)){
        $node = array_shift($queue);
        foreach($graph[$node] as $neighbor => $weight){
            $newDistance = $distance[$node] + $weight;
            if($newDistance < $distance[$neighbor]){
                $distance[$neighbor] = $newDistance;
                $queue[] = $neighbor;
            }
        }
    }
    return $distance;
}

// Usage
echo "<br>Dijkstra Algorithm:<br>";
$graph = [
    0 => [1 => 1, 2 => 4],
    1 => [2 => 2, 3 => 6],
    2 => [3 => 3],
    3 => []
];
$start = 0;
$result = dijkstra($graph, $start);
echo "Shortest distances from node $start:<br>";
print_r($result);

// Matthew Alexander Andriyanto
// 231232025
?>