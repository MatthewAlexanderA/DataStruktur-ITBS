<?php

// Priority Queue Class (Min-Heap)
class PriorityQueue {
    private $heap = [];
    private $map = [];

    // Enqueue: Menambahkan elemen ke dalam priority queue
    public function enqueue($edge, $priority) {
        $node = ['edge' => $edge, 'priority' => $priority];
        $this->heap[] = $node;
        $index = count($this->heap) - 1;
        $this->map[$index] = $node;  // Track the position of the node
        $this->heapifyUp($index);
    }

    // Dequeue: Mengambil elemen dengan prioritas tertinggi (nilai terkecil pada min-heap)
    public function dequeue() {
        if (empty($this->heap)) {
            return null;
        }

        $min = $this->heap[0];

        // Pindahkan elemen terakhir ke posisi root
        $last = array_pop($this->heap);
        if (!empty($this->heap)) {
            $this->heap[0] = $last;
            $this->map[0] = $last; // Update map for the root node
            unset($this->map[count($this->heap)]); // Remove last element from map
            $this->heapifyDown(0);
        }

        return $min['edge'];
    }

    // Helper function: Menjaga agar heap tetap terurut setelah menambahkan elemen
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

    // Helper function: Menjaga agar heap tetap terurut setelah menghapus elemen
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

    // Helper function: Menukar posisi dua elemen
    private function swap($index1, $index2) {
        $temp = $this->heap[$index1];
        $this->heap[$index1] = $this->heap[$index2];
        $this->heap[$index2] = $temp;
        $this->map[$index1] = $this->heap[$index1];
        $this->map[$index2] = $this->heap[$index2];
    }

    // Check if the queue is empty
    public function isEmpty() {
        return empty($this->heap);
    }
}

// Union-Find (Disjoint Set) Helper for Kruskal's Algorithm
class UnionFind {
    private $parent = [];
    private $rank = [];

    public function __construct($vertices) {
        foreach ($vertices as $vertex) {
            $this->parent[$vertex] = $vertex;
            $this->rank[$vertex] = 0;
        }
    }

    public function find($x) {
        if ($this->parent[$x] !== $x) {
            $this->parent[$x] = $this->find($this->parent[$x]);
        }
        return $this->parent[$x];
    }

    public function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootX !== $rootY) {
            if ($this->rank[$rootX] > $this->rank[$rootY]) {
                $this->parent[$rootY] = $rootX;
            } else {
                $this->parent[$rootX] = $rootY;
                if ($this->rank[$rootX] === $this->rank[$rootY]) {
                    $this->rank[$rootY]++;
                }
            }
        }
    }
}

// Kruskal Algorithm
function kruskal($graph) {
    $pq = new PriorityQueue();

    // Insert all edges into the priority queue
    foreach ($graph as $u => $edges) {
        foreach ($edges as $v => $weight) {
            $pq->enqueue([$u, $v], $weight);
        }
    }

    $uf = new UnionFind(array_keys($graph));
    $mst = [];

    // Process edges with the smallest weight first
    while (!$pq->isEmpty()) {
        $edge = $pq->dequeue();
        list($u, $v) = $edge;
        $weight = $graph[$u][$v];

        if ($uf->find($u) !== $uf->find($v)) {
            $uf->union($u, $v);
            $mst[] = [$u, $v, $weight];
        }
    }

    return $mst;
}

// Contoh Penggunaan Kruskal
$graph = [
    'A' => ['B' => 1, 'C' => 4],
    'B' => ['A' => 1, 'C' => 2, 'D' => 5],
    'C' => ['A' => 4, 'B' => 2, 'D' => 1],
    'D' => ['B' => 5, 'C' => 1]
];

$result = kruskal($graph);
echo "Minimum Spanning Tree (MST):<br>";
print_r($result);
?>
