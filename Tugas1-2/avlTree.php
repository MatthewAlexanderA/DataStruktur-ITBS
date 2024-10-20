<?php
class AVLTreeNode{
    public $value;
    public $left;
    public $right;
    public $height;
    public function __construct($value){
        $this->value = $value;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }
}

class AVLTree{
    private $root;

    public function __construct(){
        $this->root = null;
    }

    public function insert($value){
        $this->root = $this->insertRec($this->root, $value);
    }

    private function insertRec($node, $value){
        if($node == null){
            return new AVLTreeNode($value);
        }
        if($value < $node->value){
            $node->left = $this->insertRec($node->left, $value);
        }
        else{
            $node->right = $this->insertRec($node->right, $value);
        }
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
        return $this->balance($node);
    }

    private function balance($node){
        $balance = $this->getBalanceFactor($node);
        if($balance > 1){
            if($this->getBalanceFactor($node->left) < 0){
                $node->left = $this->rotateLeft($node->left);
            }
            return $this->rotateRight($node);
        }
        if($balance < -1){
            if ($this->getBalanceFactor($node->right) > 0) {
                $node->right = $this->rotateRight($node->right);
            }
            return $this->rotateLeft($node);
        }
        return $node;
    }

    private function rotateLeft($node){
        $newRoot = $node->right;
        $node->right = $newRoot->left;
        $newRoot->left = $node;
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
        $newRoot->height = 1 + max($this->getHeight($newRoot->left), $this->getHeight($newRoot->right));
        return $newRoot;
    }

    private function rotateRight($node){
        $newRoot = $node->left;
        $node->left = $newRoot->right;
        $newRoot->right = $node;
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
        $newRoot->height = 1 + max($this->getHeight($newRoot->left), $this->getHeight($newRoot->right));
        return $newRoot;
    }

    public function getHeight($node){
        return $node ? $node->height : 0;
    }

    public function getBalanceFactor($node){
        return $node ? $this->getHeight($node->left) - $this->getHeight($node->right) : 0;
    }

    public function inorder(){
        return $this->inorderRec($this->root);
    }

    private function inorderRec($node){
        $result = [];
        if($node !== null){
            $result = array_merge($result, $this->inorderRec($node->left));
            $result[] = $node->value;
            $result = array_merge($result, $this->inorderRec($node->right));
        }
        return $result;
    }
}

// Penggunaan
$avlTree = new AVLTree();
$avlTree->insert(10);
$avlTree->insert(20);
$avlTree->insert(30); // Menyebabkan rotasi
print_r($avlTree->inorder());
echo "<br>Matthew Alexander"
?>