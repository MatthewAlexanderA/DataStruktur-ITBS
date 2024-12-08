<?php 

class MaxHeap{
    private $heap;

    public function __construct(){
        $this->heap = array();
    }

    // Function for get index from parent node
    private function getParentIndex($index){
        return floor(($index - 1) / 2);
    }

    // Function for get index from left child node
    private function getLeftChildIndex($index){
        return 2 * $index + 1;
    }

    // Function for get index from right child node
    private function getRightChildIndex($index){
        return 2 * $index + 2;
    }

    // Function for add elemen into the heap
    public function insert($value){
        $this->heap[] = $value;
        $this->heapifyUp();
    }

    // Function for keeping heap properties from bottom to top
    private function heapifyUp(){
        $index = count($this->heap) - 1;
        while($index > 0 && $this->heap[$index] > $this->heap[$this->getParentIndex($index)]){
            $this->swap($index, $this->getParentIndex($index));
        }
    }

    // Function for delete bigest element (root) from heap
    public function extractMax(){
        if(count($this->heap) == 0){
            throw new Exception("Heap is empty");
        }
        $max = $this->heap[0];
        $this->heap[0] = array_pop($this->heap);
        $this->heapifyDown(0);
        return $max;
    }

    // Funciton for implement heap properties from top to bottom
    private function heapifyDown($index){
        $leftChildIndex = $this->getLeftChildIndex($index);
        $rightChildIndex = $this->getRightChildIndex($index);
        $largest = $index;

        if($leftChildIndex < count($this->heap) && $this->heap[$leftChildIndex] > $this->heap[$largest]){
            $largest = $leftChildIndex;
        }

        if($rightChildIndex < count($this->heap) && $this->heap[$rightChildIndex] > $this->heap[$largest]){
            $largest = $rightChildIndex;
        }

        if($largest != $index){
            $this->swap($index, $largest);
            $this->heapifyDown($largest);
        }
    }

    // Function for swap 2 element in heap
    private function swap($index1, $index2){
        $temp = $this->heap[$index1];
        $this->heap[$index1] = $this->heap[$index2];
        $this->heap[$index2] = $temp;
    }
}

// Usage
$priorityQueue = new MaxHeap();
$priorityQueue->insert(3);
$priorityQueue->insert(10);
$priorityQueue->insert(5);
$priorityQueue->insert(6);
$priorityQueue->insert(2);

// Get element with highest priority
echo "Max value: " . $priorityQueue->extractMax() . "<br>";
echo "Max value: " . $priorityQueue->extractMax() . "<br>";
echo "Max value: " . $priorityQueue->extractMax() . "<br>";

// Matthew Alexander Andriyanto
// 231232025

?>