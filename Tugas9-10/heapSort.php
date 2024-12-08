<?php 

class HeapSort{
    private $heap;

    public function __construct($array){
        $this->heap = $array;
        $this->buildMaxHeap();
    }

    // Create max heap from array
    private function buildMaxHeap(){
        $length = count($this->heap);
        for($i = floor($length/2) - 1; $i >= 0; $i--){
            $this->heapifyDown($i, $length);
        }
    }

    // Funciton for implement heap properties from top to bottom
    private function heapifyDown($index, $heapSize){
        $leftChildIndex = 2 * $index + 1;
        $rightChildIndex = 2 * $index + 2;
        $largest = $index;

        if($leftChildIndex < $heapSize && $this->heap[$leftChildIndex] > $this->heap[$largest]){
            $largest = $leftChildIndex;
        }

        if($rightChildIndex < $heapSize && $this->heap[$rightChildIndex] > $this->heap[$largest]){
            $largest = $rightChildIndex;
        }

        if($largest != $index){
            $this->swap($index, $largest);
            $this->heapifyDown($largest, $heapSize);
        }
    }

    // Function for swap 2 element in heap
    private function swap($index1, $index2){
        $temp = $this->heap[$index1];
        $this->heap[$index1] = $this->heap[$index2];
        $this->heap[$index2] = $temp;
    }

    // Function for sorting array using heap sort
    public function sort(){
        $length = count($this->heap);
        for($i = $length - 1; $i >= 1; $i--){
            $this->swap(0, $i);
            $this->heapifyDown(0, $i);
        }
        return $this->heap;
    }
}

// Usage
$array = [3, 10, 5, 6, 2, 8, 1, 4];
$heapSort = new HeapSort($array);
$sortedArray = $heapSort->sort();

echo "Array terurut: ";
print_r($sortedArray);

// Matthew Alexander Andriyanto
// 231232025

?>