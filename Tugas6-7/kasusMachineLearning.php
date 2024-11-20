<?php 

// Class node for implement BST structure
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

// Class for implementation structure BST
class PredictionTree{
    public $root;

    public function __construct(){
        $this->root = null;
    }

    // Function for adding prediction value to BST
    public function addPrediction($value){
        $newNode = new TreeNode($value);
        if($this->root === null){
            $this->root = $newNode;
        } else{
            $this->insertNode($this->root, $newNode);
        }
    }

    // Recursive funciton for saving new node to BST
    private function insertNode($node, $newNode){
        if($newNode->value < $node->value){
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

    // Function for showing sorted prediction
    public function displayPrediction($node){
        if($node !== null){
            $this->displayPrediction($node->left);
            echo "Prediction Accuracy: " . $node->value . "% <br>";
            $this->displayPrediction($node->right);
        }
    }
}

// Usage
$modelTree = new PredictionTree();

// Adding prediction to tree
$modelTree->addPrediction(78.5);
$modelTree->addPrediction(85.3);
$modelTree->addPrediction(90.4);
$modelTree->addPrediction(80.1);

// Showing the sorted prediction result from lowest to highest
$modelTree->displayPrediction($modelTree->root);

?>