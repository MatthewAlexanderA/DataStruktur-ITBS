<?php

class AVLNode {
    public $data;
    public $left;
    public $right;
    public $height;

    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }
}

class AVLTree {
    private $root;

    public function __construct() {
        $this->root = null;
    }

    private function getHeight($node) {
        if ($node === null) {
            return 0;
        }
        return $node->height;
    }

    private function getBalance($node) {
        if ($node === null) {
            return 0;
        }
        return $this->getHeight($node->left) - $this->getHeight($node->right);
    }

    private function rightRotate($y) {
        $x = $y->left;
        $T2 = $x->right;

        $x->right = $y;
        $y->left = $T2;

        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;

        return $x;
    }

    private function leftRotate($x) {
        $y = $x->right;
        $T2 = $y->left;

        $y->left = $x;
        $x->right = $T2;

        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;

        return $y;
    }

    public function insert($data) {
        $this->root = $this->insertRec($this->root, $data);
    }

    private function insertRec($node, $data) {
        if ($node === null) {
            return new AVLNode($data);
        }

        if ($data < $node->data) {
            $node->left = $this->insertRec($node->left, $data);
        } else if ($data > $node->data) {
            $node->right = $this->insertRec($node->right, $data);
        } else {
            return $node; // Duplicate data not allowed
        }

        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));

        $balance = $this->getBalance($node);

        // Left Left Case
        if ($balance > 1 && $data < $node->left->data) {
            return $this->rightRotate($node);
        }

        // Right Right Case
        if ($balance < -1 && $data > $node->right->data) {
            return $this->leftRotate($node);
        }

        // Left Right Case
        if ($balance > 1 && $data > $node->left->data) {
            $node->left = $this->leftRotate($node->left);
            return $this->rightRotate($node);
        }

        // Right Left Case
        if ($balance < -1 && $data < $node->right->data) {
            $node->right = $this->rightRotate($node->right);
            return $this->leftRotate($node);
        }

        return $node;
    }

    public function delete($data) {
        $this->root = $this->deleteRec($this->root, $data);
    }

    private function deleteRec($node, $data) {
        if ($node === null) {
            return $node;
        }

        if ($data < $node->data) {
            $node->left = $this->deleteRec($node->left, $data);
        } else if ($data > $node->data) {
            $node->right = $this->deleteRec($node->right, $data);
        } else {
            // Node with only one child or no child
            if ($node->left === null) {
                return $node->right;
            } else if ($node->right === null) {
                return $node->left;
            }

            // Node with two children: Get the inorder successor (smallest in the right subtree)
            $node->data = $this->minValue($node->right);

            // Delete the inorder successor
            $node->right = $this->deleteRec($node->right, $node->data);
        }

        // If the tree had only one node, return
        if ($node === null) {
            return $node;
        }

        // Update height of the current node
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));

        // Get the balance factor
        $balance = $this->getBalance($node);

        // Left Left Case
        if ($balance > 1 && $this->getBalance($node->left) >= 0) {
            return $this->rightRotate($node);
        }

        // Left Right Case
        if ($balance > 1 && $this->getBalance($node->left) < 0) {
            $node->left = $this->leftRotate($node->left);
            return $this->rightRotate($node);
        }

        // Right Right Case
        if ($balance < -1 && $this->getBalance($node->right) <= 0) {
            return $this->leftRotate($node);
        }

        // Right Left Case
        if ($balance < -1 && $this->getBalance($node->right) > 0) {
            $node->right = $this->rightRotate($node->right);
            return $this->leftRotate($node);
        }

        return $node;
    }

    private function minValue($node) {
        $current = $node;
        while ($current->left !== null) {
            $current = $current->left;
        }
        return $current->data;
    }

    public function search($data) {
        return $this->searchRec($this->root, $data);
    }

    private function searchRec($node, $data) {
        if ($node === null || $node->data === $data) {
            return $node;
        }

        if ($data < $node->data) {
            return $this->searchRec($node->left, $data);
        }

        return $this->searchRec($node->right, $data);
    }
}

// Usage
$avlTree = new AVLTree();
$avlTree->insert(10);
$avlTree->insert(20);
$avlTree->insert(30);
$avlTree->insert(40);
$avlTree->insert(50);
$avlTree->insert(25);

$avlTree->delete(30);

$result = $avlTree->search(25);
if ($result !== null) {
    echo "Node found: " . $result->data . "<br>";
} else {
    echo "Node not found.<br>";
}

// Matthew Alexander Andriyanto
// 231232025
?>