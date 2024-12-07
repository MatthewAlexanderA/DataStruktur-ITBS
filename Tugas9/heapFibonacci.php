<?php

class FibonacciNode {
    public $value;
    public $degree = 0;
    public $parent = null;
    public $children = [];  // This will be an array of child nodes.
    public $marked = false;
    public $next = null;
    public $prev = null;

    public function __construct($value) {
        $this->value = $value;
    }
}

class FibonacciHeap {
    private $minNode = null;
    private $totalNodes = 0;

    // Insert a value into the Fibonacci heap
    public function insert($value) {
        $newNode = new FibonacciNode($value);
        $this->addToRootList($newNode);

        if (!$this->minNode || $newNode->value < $this->minNode->value) {
            $this->minNode = $newNode;
        }

        $this->totalNodes++;
    }

    // Add a node to the root list of the heap
    private function addToRootList($node) {
        if ($this->minNode === null) {
            $this->minNode = $node;
            $node->next = $node;
            $node->prev = $node;
        } else {
            $node->next = $this->minNode;
            $node->prev = $this->minNode->prev;
            $this->minNode->prev->next = $node;
            $this->minNode->prev = $node;
        }
    }

    // Extract the minimum value node from the Fibonacci heap
    public function extractMin() {
        if (!$this->minNode) {
            return null;
        }

        $extractedMin = $this->minNode->value;

        // Move children of the min node to the root list
        $child = $this->minNode->children;
        foreach ($child as $ch) {
            // Disconnect from parent and move to root list
            $ch->parent = null;
            $this->addToRootList($ch);
        }

        // Remove the min node from the root list
        $this->minNode->prev->next = $this->minNode->next;
        $this->minNode->next->prev = $this->minNode->prev;
        $this->minNode = $this->minNode->next; // Set the next node as the new min node

        $this->totalNodes--;

        if ($this->minNode) {
            // Perform consolidation to maintain the heap structure
            $this->consolidate();
        }

        return $extractedMin;
    }

    // Consolidate the heap by merging trees of the same degree
    private function consolidate() {
        $degreeTable = [];
        $current = $this->minNode;
        $nodes = [];

        // Collect all the root nodes in an array for consolidation
        do {
            $nodes[] = $current;
            $current = $current->next;
        } while ($current !== $this->minNode);

        // Consolidate trees by merging trees of the same degree
        foreach ($nodes as $node) {
            $degree = $node->degree;
            while (isset($degreeTable[$degree])) {
                $other = $degreeTable[$degree];
                if ($node->value > $other->value) {
                    $temp = $node;
                    $node = $other;
                    $other = $temp;
                }

                // Link the trees
                $this->linkTrees($node, $other);
                unset($degreeTable[$degree]);

                $degree++;
            }

            $degreeTable[$degree] = $node;
        }

        // Set the new min node
        $this->minNode = null;
        foreach ($degreeTable as $tree) {
            if (!$this->minNode || $tree->value < $this->minNode->value) {
                $this->minNode = $tree;
            }
        }
    }

    // Link two trees by making the second tree a child of the first
    private function linkTrees($current, $other) {
        // Remove the other tree from the root list
        $other->prev->next = $other->next;
        $other->next->prev = $other->prev;

        // Make the other tree a child of the current tree
        $current->children[] = $other;
        $other->parent = $current;
        $current->degree++;
        $other->marked = false;
    }
}

// Usage
echo "=== Fibonacci Heap ===<br>";
$fibHeap = new FibonacciHeap();
$fibHeap->insert(10);
$fibHeap->insert(20);
$fibHeap->insert(5);
$fibHeap->insert(15);

echo "Minimum extracted: " . $fibHeap->extractMin() . "<br>"; 
echo "Minimum extracted: " . $fibHeap->extractMin() . "<br>"; 

// Matthew Alexander Andriyanto
// 231232025
?>
