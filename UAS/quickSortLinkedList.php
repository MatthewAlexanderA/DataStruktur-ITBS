<?php 

class Node {
    public $data;
    public $next;
    
    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class LinkedList {
    public $head;
    
    public function __construct() {
        $this->head = null;
    }
    
    public function addNode($data) {
        $newNode = new Node($data);
        if ($this->head === null) {
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $newNode;
        }
    }
    
    public function quickSort($node) {
        if ($node === null || $node->next === null) {
            return $node;
        }
        
        $pivot = $node;
        $lessHead = new Node(0);
        $greaterHead = new Node(0);
        $less = $lessHead;
        $greater = $greaterHead;
        $current = $node->next;
        
        while ($current !== null) {
            if ($current->data < $pivot->data) {
                $less->next = $current;
                $less = $less->next;
            } else {
                $greater->next = $current;
                $greater = $greater->next;
            }
            $current = $current->next;
        }
        
        $less->next = null;
        $greater->next = null;
        
        $sortedLess = $this->quickSort($lessHead->next);
        $sortedGreater = $this->quickSort($greaterHead->next);
        
        $pivot->next = $sortedGreater;
        
        if ($sortedLess === null) {
            return $pivot;
        }
        
        $last = $sortedLess;
        while ($last->next !== null) {
            $last = $last->next;
        }
        $last->next = $pivot;
        
        return $sortedLess;
    }
    
    public function sort() {
        $this->head = $this->quickSort($this->head);
    }
    
    public function printList() {
        $current = $this->head;
        while ($current !== null) {
            echo $current->data . " ";
            $current = $current->next;
        }
        echo "\n";
    }
}

// usage
$list = new LinkedList();
$list->addNode(3);
$list->addNode(1);
$list->addNode(4);
$list->addNode(2);

echo "Before sorting: ";
$list->printList();

$list->sort();

echo "<br>";
echo "After sorting: ";
$list->printList();


// Matthew Alexander Andriyanto
// 231232025
?>