<?php

class BinomialTree {
    public $value;
    public $children = [];

    public function __construct($value) {
        $this->value = $value;
    }

    public function merge($other) {
        // Choose the root based on the smaller value
        if ($this->value > $other->value) {
            return $other->merge($this);
        }
        $this->children[] = $other; // add other tree as child
        return $this;
    }
}

class BinomialHeap {
    private $trees = [];

    public function insert($value) {
        $newTree = new BinomialTree($value);
        $this->mergeTrees([$newTree]);
    }

    private function mergeTrees($otherTrees) {
        $this->trees = array_merge($this->trees, $otherTrees);
        usort($this->trees, function($a, $b) {
            return count($a->children) - count($b->children);
        });

        $i = 0;
        while ($i < count($this->trees) - 1) {
            if (count($this->trees[$i]->children) == count($this->trees[$i + 1]->children)) {
                $mergedTree = $this->trees[$i]->merge($this->trees[$i + 1]);
                array_splice($this->trees, $i, 2, [$mergedTree]);
            } else {
                $i++;
            }
        }
    }

    public function extractMin() {
        if (empty($this->trees)) {
            return null;
        }

        // find tree with lowest value
        $minIndex = 0;
        foreach ($this->trees as $i => $tree) {
            if ($tree->value < $this->trees[$minIndex]->value) {
                $minIndex = $i;
            }
        }

        // remove the min tree from the list and to chield tree
        $minTree = array_splice($this->trees, $minIndex, 1)[0];
        $this->mergeTrees($minTree->children);

        return $minTree->value;
    }
}

// Usage
echo "=== Binomial Heap ===<br>";
$binHeap = new BinomialHeap();
$binHeap->insert(10);
$binHeap->insert(20);
$binHeap->insert(5);    
$binHeap->insert(15);

echo "Minimum extracted: " . $binHeap->extractMin() . "<br>"; 
echo "Minimum extracted: " . $binHeap->extractMin() . "<br>"; 

// Matthew Alexander Andriyanto
// 231232025
?>
