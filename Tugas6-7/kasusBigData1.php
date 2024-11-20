<?php 

// Node Class for implementation each node in BST

class LogNode{
    public $timestamp;
    public $message;
    public $left;
    public $right;

    public function __construct($timestamp, $message){
        $this->timestamp = $timestamp;
        $this->message = $message;
        $this->left = null;
        $this->right = null;
    }
}

// Class for Binary Search Tree Structure
class LogTree{
    public $root;

    public function __construct(){
        $this->root = null;
    }

    // Function for adding data log to BST
    public function addLog($timestamp, $message){
        $newNode = new LogNode($timestamp, $message);
        if($this->root === null){
            $this->root = $newNode;
        } else{
            $this->insertNode($this->root, $newNode);
        }
    }

    // Recursive Function for define new node in tree
    private function insertNode($node, $newNode){
        if($newNode->timestamp < $node->timestamp){
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

    // Recursive Function for searching log depends on timestamp
    public function searchLog($timestamp){
        return $this->searchNode($this->root, $timestamp);
    }

    // Recursive Function for searching node depends on timestamp
    private function searchNode($node, $timestamp){
        if($node === null){
            return null; // Data didnt exist
        } 
        if($timestamp === $node->timestamp){
            return $node; // Data exist
        } elseif($timestamp < $node->timestamp){
            return $this->searchNode($node->left, $timestamp);
        } else{
            return $this->searchNode($node->right, $timestamp);
        }
    }
}

// Usage
$logTree = new LogTree();

// Add some data log
$logTree->addLog(1618300000, "Server 1 started");
$logTree->addLog(1618300500, "Server 2 started");
$logTree->addLog(1618301000, "Database connection established");
$logTree->addLog(1618302000, "User login attempt");

// Search log depends on timestamp
$searchTime = 1618300500;
$foundLog = $logTree->searchLog($searchTime);
if($foundLog !== null){
    echo "Log found: " . $foundLog->message . " at " . $foundLog->timestamp . "<br>";
} else{
    echo "No log found for timestamp " . $searchTime . "<br>";
}

// Matthew Alexander Andriyanto
// 231232025

?>