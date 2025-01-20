<?php
function aStar($graph, $start, $goal, $heuristic){
    $distance = array_fill(0, count($graph), INF);
    $distance[$start] = 0;
    $queue = array($start);
    while(!empty($queue)){
        $node = array_shift($queue);
        if($node == $goal){
            return $distance[$node];
        }
        foreach($graph[$node] as $neighbor => $weight){
            $newDistance = $distance[$node] + $weight;
            if($newDistance < $distance[$neighbor]){
                $distance[$neighbor] = $newDistance;
                $queue[] = $neighbor;
            }
        }
    }
    return -1;
}

// usage
echo "<br>A* Algorithm:<br>";
$graph = [
    0 => [1 => 1, 2 => 4],
    1 => [2 => 2, 3 => 6],
    2 => [3 => 3],
    3 => []
];

$heuristic = [
    0 => 7,
    1 => 6,
    2 => 2,
    3 => 0
];

$start = 0;
$goal = 3;

echo aStar($graph, $start, $goal, $heuristic);

// Matthew Alexander Andriyanto
// 231232025
?>