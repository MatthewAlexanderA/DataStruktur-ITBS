<?php
function bfs($graph, $target) {
    $visited = array();
    $queue = array(0); 
    while (!empty($queue)) {
        $node = array_shift($queue); 
        if ($node == $target) {
            return true;
        }
        if (!in_array($node, $visited)) {
            $visited[] = $node; 
            if (isset($graph[$node])) {
                foreach ($graph[$node] as $neighbor) {
                    $queue[] = $neighbor;
                }
            }
        }
    }
    return false;
}

// Usage
echo "<br>Breadth First Search (BFS):<br>";
$graph = [
    0 => [1, 2],
    1 => [0, 3, 4],
    2 => [0, 5],
    3 => [1],
    4 => [1, 5],
    5 => [2, 4]
];

$target = 5; // The node we are searching for

// Call the BFS function
$result = bfs($graph, $target);
echo "Target $target is " . ($result ? "reachable" : "not reachable") . " from node 0\n";

// Matthew Alexander Andriyanto
// 231232025
?>