<?php

class PriorityQueue {
    private $heap = [];
    private $map = []; // To keep track of the positions of the nodes in the heap

    // Enqueue
    public function enqueue($value, $priority) {
        $node = ['value' => $value, 'priority' => $priority];
        $this->heap[] = $node;
        $index = count($this->heap) - 1;
        $this->map[$value] = $index;  // Track the position of the node
        $this->heapifyUp($index);
    }

    // Update the priority of a node
    public function updatePriority($value, $newPriority) {
        if (isset($this->map[$value])) {
            $index = $this->map[$value];
            $this->heap[$index]['priority'] = $newPriority;
            $this->heapifyUp($index);  // Ensure the heap property is maintained
        }
    }

    // Dequeue
    public function dequeue() {
        if (empty($this->heap)) {
            return null;
        }

        $min = $this->heap[0];

        // move the last element to the root position
        $last = array_pop($this->heap);
        if (!empty($this->heap)) {
            $this->heap[0] = $last;
            $this->map[$last['value']] = 0; // Update map for the root node
            unset($this->map[$min['value']]); // Remove the old root from map
            $this->heapifyDown(0);
        }

        return $min['value'];
    }

    // Peek
    public function peek() {
        if (empty($this->heap)) {
            return null;
        }
        return $this->heap[0]['value'];
    }

    // make element sorted after add element
    private function heapifyUp($index) {
        while ($index > 0) {
            $parentIndex = floor(($index - 1) / 2);
            if ($this->heap[$index]['priority'] < $this->heap[$parentIndex]['priority']) {
                $this->swap($index, $parentIndex);
                $index = $parentIndex;
            } else {
                break;
            }
        }
    }

    // make element sorted after delete element
    private function heapifyDown($index) {
        $size = count($this->heap);
        while (2 * $index + 1 < $size) {
            $leftChildIndex = 2 * $index + 1;
            $rightChildIndex = 2 * $index + 2;
            $smallerChildIndex = $leftChildIndex;

            if ($rightChildIndex < $size && $this->heap[$rightChildIndex]['priority'] < $this->heap[$leftChildIndex]['priority']) {
                $smallerChildIndex = $rightChildIndex;
            }

            if ($this->heap[$index]['priority'] > $this->heap[$smallerChildIndex]['priority']) {
                $this->swap($index, $smallerChildIndex);
                $index = $smallerChildIndex;
            } else {
                break;
            }
        }
    }

    // switch 2 element
    private function swap($index1, $index2) {
        $temp = $this->heap[$index1];
        $this->heap[$index1] = $this->heap[$index2];
        $this->heap[$index2] = $temp;
        $this->map[$this->heap[$index1]['value']] = $index1;
        $this->map[$this->heap[$index2]['value']] = $index2;
    }

    // Check if the queue is empty
    public function isEmpty() {
        return empty($this->heap);
    }
}

// Dijkstra Algorithm
function dijkstra($graph, $start) {
    $dist = [];
    $prev = [];
    $pq = new PriorityQueue();

    // Initialize distances and prev for each vertex
    foreach ($graph as $vertex => $edges) {
        $dist[$vertex] = INF;
        $prev[$vertex] = null;
        $pq->enqueue($vertex, $dist[$vertex]);
    }

    $dist[$start] = 0;
    $pq->updatePriority($start, $dist[$start]);

    while (!$pq->isEmpty()) {
        $u = $pq->dequeue();

        foreach ($graph[$u] as $v => $weight) {
            $alt = $dist[$u] + $weight;
            if ($alt < $dist[$v]) {
                $dist[$v] = $alt;
                $prev[$v] = $u;
                $pq->updatePriority($v, $dist[$v]);
            }
        }
    }

    return ['distances' => $dist, 'previous' => $prev];
}

// Usage
$graph = [
    'A' => ['B' => 1, 'C' => 4],
    'B' => ['A' => 1, 'C' => 2, 'D' => 5],
    'C' => ['A' => 4, 'B' => 2, 'D' => 1],
    'D' => ['B' => 5, 'C' => 1]
];

$result = dijkstra($graph, 'A');
echo "Shortest distances from A:<br>";
print_r($result['distances']);

// Matthew Alexander Andriyanto
// 231232025

?>
