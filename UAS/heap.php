<?php

class MinHeap {
    private $heap;

    public function __construct() {
        $this->heap = [];
    }

    private function parent($i) {
        return ($i - 1) >> 1; // Equivalent to floor(($i - 1) / 2)
    }

    private function leftChild($i) {
        return ($i << 1) + 1; // Equivalent to 2 * $i + 1
    }

    private function rightChild($i) {
        return ($i << 1) + 2; // Equivalent to 2 * $i + 2
    }

    private function swap(&$x, &$y) {
        $temp = $x;
        $x = $y;
        $y = $temp;
    }

    public function insert($value) {
        $this->heap[] = $value;
        $this->heapifyUp(count($this->heap) - 1);
    }

    private function heapifyUp($i) {
        while ($i > 0 && $this->heap[$this->parent($i)] > $this->heap[$i]) {
            $this->swap($this->heap[$i], $this->heap[$this->parent($i)]);
            $i = $this->parent($i);
        }
    }

    public function extractMin() {
        if (count($this->heap) === 0) {
            throw new Exception("Heap is empty");
        }

        $min = $this->heap[0];
        $this->heap[0] = array_pop($this->heap);
        $this->heapifyDown(0);

        return $min;
    }

    private function heapifyDown($i) {
        $size = count($this->heap);
        $minIndex = $i;

        $left = $this->leftChild($i);
        if ($left < $size && $this->heap[$left] < $this->heap[$minIndex]) {
            $minIndex = $left;
        }

        $right = $this->rightChild($i);
        if ($right < $size && $this->heap[$right] < $this->heap[$minIndex]) {
            $minIndex = $right;
        }

        if ($i !== $minIndex) {
            $this->swap($this->heap[$i], $this->heap[$minIndex]);
            $this->heapifyDown($minIndex);
        }
    }

    public function delete($value) {
        $index = array_search($value, $this->heap);
        if ($index === false) {
            throw new Exception("Value not found in heap");
        }

        $this->heap[$index] = $this->heap[count($this->heap) - 1];
        array_pop($this->heap);

        if ($index < count($this->heap)) {
            $this->heapifyDown($index);
            $this->heapifyUp($index);
        }
    }

    public function printHeap() {
        echo "Heap: " . implode(", ", $this->heap) . "<br>";
    }
}

// Usage
$minHeap = new MinHeap();
$minHeap->insert(5);
$minHeap->insert(3);
$minHeap->insert(8);
$minHeap->insert(1);
$minHeap->insert(10);

$minHeap->printHeap(); 

echo "Extracted Min: " . $minHeap->extractMin() . "<br>"; 
$minHeap->printHeap(); 

$minHeap->delete(5);
$minHeap->printHeap(); 


// Matthew Alexander Andriyanto
// 231232025
?>