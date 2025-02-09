<?php 

class GraphNode {
    public $data;
    public $neighbors;

    public function __construct($data) {
        $this->data = $data;
        $this->neighbors = [];
    }

    public function addNeighbor($neighbor) {
        $this->neighbors[] = $neighbor;
    }
}

class Graph {
    public $nodes;

    public function __construct() {
        $this->nodes = [];
    }

    public function addNode($data) {
        $this->nodes[] = new GraphNode($data);
    }

    public function binarySearchOnGraph($target) {
        // Asumsi: node-node dalam graf sudah terurut berdasarkan nilai data
        usort($this->nodes, function($a, $b) {
            return $a->data <=> $b->data;
        });

        return $this->binarySearchHelper($this->nodes, $target, 0, count($this->nodes) - 1);
    }

    private function binarySearchHelper($nodes, $target, $left, $right) {
        if ($left > $right) {
            return null; // Target tidak ditemukan
        }

        $mid = intval(($left + $right) / 2);

        if ($nodes[$mid]->data === $target) {
            return $nodes[$mid]; // Node ditemukan
        } elseif ($nodes[$mid]->data < $target) {
            return $this->binarySearchHelper($nodes, $target, $mid + 1, $right);
        } else {
            return $this->binarySearchHelper($nodes, $target, $left, $mid - 1);
        }
    }
}

// Usage
$graph = new Graph();
$graph->addNode(10);
$graph->addNode(20);
$graph->addNode(30);
$graph->addNode(40);
$graph->addNode(50);

$targetNode = $graph->binarySearchOnGraph(30);

if ($targetNode !== null) {
    echo "Node ditemukan: " . $targetNode->data . "<br>";
} else {
    echo "Node tidak ditemukan.<br>";
}

// Matthew Alexander Andriyanto
// 231232025
?>