<?php
class TreeNode{
    public $value;
    public $left;
    public $right;
    public function __construct($value){
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }
}

class BST{
    private $root;

    public function __construct(){
        $this->root = null;
    }

    public function insert($value){
        $this->root = $this->insertRec($this->root, $value);
    }

    private function insertRec($node, $value){
        if($node == null){
            return new TreeNode($value);
        }
        if($value < $node->value){
            $node->left = $this->insertRec($node->left, $value);
        }
        else{
            $node->right = $this->insertRec($node->right, $value);
        }
        return $node;
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
$bst = new BST();
$bst->insert(15);
$bst->insert(10);
$bst->insert(20);
print_r($bst->inorder());
echo "<br>Matthew Alexander"
?>