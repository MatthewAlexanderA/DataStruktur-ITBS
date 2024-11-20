<?php 

// Class Node for present each node in BST
class SensorNode{
    public $sensorID;
    public $temperature;
    public $left;
    public $right;

    public function __construct($sensorID, $temperature){
        $this->sensorID = $sensorID;
        $this->temperature = $temperature;
        $this->left = null;
        $this->right = null;
    }
}

// Class for structure BST for data sensor
class SensorDataTree{
    public $root;

    public function __construct(){
        $this->root = null;
    }

    // Funciton for adding data sensor to BST
    public function addSensorData($sensorID, $temperature){
        $newNode = new SensorNode($sensorID, $temperature);
        if($this->root === null){
            $this->root = $newNode;
        } else{
            $this->insertNode($this->root, $newNode);
        }
    }

    // Recursive function for add new node to tree
    private function insertNode($node, $newNode){
        if($newNode->temperature < $node->temperature){
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

    // Function for seaching data sensor depends on temperature
    public function searchByTemperature($temperature){
        return $this->searchNode($this->root, $temperature);
    }

    // Recursive function for searching node depends on temperature
    private function searchNode($node, $temperature){
        if($node === null){
            return null; // Data didnt exist
        }
        if($temperature === $node->temperature){
            return $node; // Data exist
        } elseif($temperature < $node->temperature){
            return $this->searchNode($node->left, $temperature);
        } else{
            return $this->searchNode($node->right, $temperature);
        }
    }
}

// Usage
$sensorTree = new SensorDataTree();

// Add some data sensor
$sensorTree->addSensorData(101, 22.5);
$sensorTree->addSensorData(102, 19.8);
$sensorTree->addSensorData(103, 25.1);
$sensorTree->addSensorData(104, 23.4);

// Searching data sensor depends on temperature
$searchTemp = 23.4;
$foundNode = $sensorTree->searchByTemperature($searchTemp);
if($foundNode !== null){
    echo "Sensor with ID " . $foundNode->sensorID . " has a temperature of " . $foundNode->temperature . "<br>";
} else{
    echo "No sensor data found for temperature " . $searchTemp . "°C <br>";
}

?>