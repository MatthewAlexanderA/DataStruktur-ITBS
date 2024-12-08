<?php 

class MinHeap{
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
        while($index > 0 && $this->heap[$index] < $this->heap[$this->getParentIndex($index)]){
            $this->swap($index, $this->getParentIndex($index));
            $index = $this->getParentIndex($index);
        }
    }

    // Function for delete smallest element (root) from heap
    public function extractMin(){
        if(count($this->heap) == 0){
            throw new Exception("Heap is empty");
        }
        $min = $this->heap[0];
        $this->heap[0] = array_pop($this->heap);
        $this->heapifyDown(0);
        return $min;
    }

    // Funciton for implement heap properties from top to bottom
    private function heapifyDown($index){
        $leftChildIndex = $this->getLeftChildIndex($index);
        $rightChildIndex = $this->getRightChildIndex($index);
        $smallest = $index;

        if($leftChildIndex < count($this->heap) && $this->heap[$leftChildIndex] < $this->heap[$smallest]){
            $smallest = $leftChildIndex;
        }

        if($rightChildIndex < count($this->heap) && $this->heap[$rightChildIndex] < $this->heap[$smallest]){
            $smallest = $rightChildIndex;
        }

        if($smallest != $index){
            $this->swap($index, $smallest);
            $this->heapifyDown($smallest);
        }
    }

    // Function for swap 2 element in heap
    private function swap($index1, $index2){
        $temp = $this->heap[$index1];
        $this->heap[$index1] = $this->heap[$index2];
        $this->heap[$index2] = $temp;
    }

    // Function for get smallest element (root) without deleting it
    public function peek(){
        if(count($this->heap) == 0){
            throw new Exception("Heap is empty");
        }
        return $this->heap[0];
    } 

    // Function for print elements in heap
    public function printHeap(){
        foreach($this->heap as $value) {
            echo $value . ", ";
        }
        echo "<br>";
    }
}

// Usage
$minHeap = new MinHeap();
$minHeap->insert(3);
$minHeap->insert(10);
$minHeap->insert(5);
$minHeap->insert(6);
$minHeap->insert(2);

$minHeap->printHeap();

echo "Min value: " . $minHeap->extractMin() . "<br>";
$minHeap->printHeap()

// Matthew Alexander Andriyanto
// 231232025

?>