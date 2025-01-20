<?php
function dfs($graph, $target) {
    $visited = array();
    $stack = array(0); 
    while (!empty($stack)) {
        $node = array_pop($stack);
        if ($node == $target) {
            return true;
        }
        if (!in_array($node, $visited)) {
            $visited[] = $node; 
            if (isset($graph[$node])) {
                foreach ($graph[$node] as $neighbor) {
                    $stack[] = $neighbor;
                }
            }
        }
    }
    return false;
}

// Usage
echo "<br>Depth First Search (DFS):<br>";
$graph = [
    0 => [1, 2],
    1 => [0, 3, 4],
    2 => [0, 5],
    3 => [1],
    4 => [1, 5],
    5 => [2, 4]
];
$target = 5;
$result = dfs($graph, $target);
echo "Target $target is " . ($result ? "reachable" : "not reachable") . " from node 0<br>";

// Matthew Alexander Andriyanto
// 231232025
?>