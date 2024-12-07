<?php

class PriorityQueue {
    private $heap = [];
    
    // Enqueue
    public function enqueue($value, $priority) {
        $node = ['value' => $value, 'priority' => $priority];
        $this->heap[] = $node;
        $this->heapifyUp(count($this->heap) - 1);
    }

    // Dequeue
    public function dequeue() {
        if (empty($this->heap)) {
            return null;
        }
        
        // get the most priority element
        $min = $this->heap[0];
        
        // move the last element to the root position
        $last = array_pop($this->heap);
        if (!empty($this->heap)) {
            $this->heap[0] = $last;
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

    // check if queue is empty
    public function isEmpty() {
        return empty($this->heap);
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
    }
}

// Usage
$priorityQueue = new PriorityQueue();

// Enqueue some element
$priorityQueue->enqueue("Task A", 3); // Prioritas 3
$priorityQueue->enqueue("Task B", 1); // Prioritas 1
$priorityQueue->enqueue("Task C", 2); // Prioritas 2

// peek
echo "Peek: " . $priorityQueue->peek() . "<br>"; 

// Dequeue element
echo "Dequeued: " . $priorityQueue->dequeue() . "<br>"; 
echo "Dequeued: " . $priorityQueue->dequeue() . "<br>"; 
echo "Dequeued: " . $priorityQueue->dequeue() . "<br>"; 

// check if priority queue is empty
echo "Is Empty: " . ($priorityQueue->isEmpty() ? "Yes" : "No") . "<br>"; 

// Matthew Alexander Andriyanto
// 231232025

?>
