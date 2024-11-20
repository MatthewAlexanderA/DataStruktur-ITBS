<?php 

// Class node for each element in BST
class DataNode{
    public $id;
    public $left;
    public $right;

    public function __construct($id){
        $this->id = $id;
        $this->left = null;
        $this->right = null;
    }
}

// Class for implementation BST structur
class DataIndexTree{
    public $root;

    public function __construct(){
        $this->root = null;
    }

    // Function for adding ID data to tree
    public function addData($id){
        $newNode = new DataNode($id);
        if($this->root === null){
            $this->root = $newNode;
        } else{
            $this->insertNode($this->root, $newNode);
        }
    }

    // Recursive function for saving new node
    private function insertNode($node, $newNode){
        if($newNode->id < $node->id){
            if($node->left === null){
                $node->left = $newNode;
            } else{
                $this->insertNode($node->left, $newNode);
            }
        } else{
            if($node->right === null){
                $node->right = $newNode;
            } else{
                $this->insertNode($node->right, $newNode);
            }
        }
    }

    // Function for searching ID data from tree
    public function searchData($id){
        return $this->searchNode($this->root, $id);
    }

    // Recursive function for searching spesific node from tree
    private function searchNode($node, $id){
        if($node === null){
            return false; // Data didnt exist
        } 
        if($id === $node->id){
            return true; // Data exist
        } elseif($id < $node->id){
            return $this->searchNode($node->left, $id);
        } else{
            return $this->searchNode($node->right, $id);
        }
    }
}

// Usage
$dataTree = new DataIndexTree();

// Adding some ID data
$dataTree->addData(101);
$dataTree->addData(205);
$dataTree->addData(150);
$dataTree->addData(89);

// Searching ID data
$searchID = 150;
if($dataTree->searchData($searchID)){
    echo "Data with ID " . $searchID . " found in the index. <br>";
}

?>