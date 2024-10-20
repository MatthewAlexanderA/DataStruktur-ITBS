<?php 

class LogNode{
    public $itemName;
    public $quantity;
    public $timestamp;
    public $next;
    public $prev;

    public function __construct($itemName, $quantity, $timestamp) {
        $this->itemName = $itemName;
        $this->quantity = $quantity;
        $this->timestamp = $timestamp;
        $this->next = null;
        $this->prev = null;
    }
}

class CircularLogList{
    private $head = null;
    private $tail = null;

    // Add Log for Outgoing Item
    public Function addLog($itemName, $quantity){
        $timestamp = date("Y-m-d H:i:s");
        $newLog = new LogNode($itemName, $quantity, $timestamp);
        if($this->head === null){
            $this->head = $newLog;
            $this->tail = $newLog;
            $this->tail->next = $this->head;
            $this->head->prev = $this->tail;
        } else{
            $this->tail->next = $newLog;
            $newLog->prev = $this->tail;
            $this->tail = $newLog;
            $this->tail->next = $this->head;
            $this->head->prev = $this->tail;
        }
    }

    // Get Outgoinf Log
    public function displayLog(){
        if($this->head === null){
            return "No Logs Available";
        }

        $current = $this->head;
        $logOutput = "";
        do{
            $logOutput .= "Item: " . $current->itemName . " Quantity: " . $current->quantity . " Time: " . $current->timestamp . "<br>";
            $current = $current->next;
        } while ($current !== $this->head);

        return $logOutput;
    }
}

// Usage of CircularLogList
$logList = new CircularLogList();
$logList->addLog("Laptop", 2);
$logList->addLog("Printer", 1);
$logList->addLog("Scanner", 1);

// Get All Outgoing Log
echo "Log of Exited Items: <br>";
echo $logList->displayLog();

// Nama: Matthew Alexander Andriyanto
// NIM: 231232025

?>