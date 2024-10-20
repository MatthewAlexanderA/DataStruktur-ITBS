<?php
class Graph{
    private $adjacencyList = [];
    public function addVertex($vertex){
        $this->adjacencyList[$vertex] = [];
    }

    public function addEdge($vertex1, $vertex2){
        $this->adjacencyList[$vertex1][] = $vertex2;
        $this->adjacencyList[$vertex2][] = $vertex1; // Graph tidak berarah
    }

    public function getAdjacency(){
        return $this->adjacencyList;
    }
}

// Penggunaan
$graph = new Graph();
$graph->addVertex("A");
$graph->addVertex("B");
$graph->addEdge("A", "B");
print_r($graph->getAdjacency());
echo "<br>Matthew Alexander"
?>