<?php

class ItemNode{
    public $itemName;
    public $quantity;
    public $next;

    public function __construct($itemName, $quantity){
        $this->itemName = $itemName;
        $this->quantity = $quantity;
        $this->next = null;
    }
}

class CircularItemList{
    private $head = null;
    private $tail = null;

    // Add Item
    public function addItem($itemName, $quantity){
        $newItem = new ItemNode($itemName, $quantity);
        if ($this->head === null) {
            $this->head = $newItem;
            $this->tail = $newItem;
            $this->tail->next = $this->head; // Create Circular
        } else{
            $this->tail->next = $newItem;
            $this->tail = $newItem;
            $this->tail->next = $this->head; // Still Circular
        }
    } 

    // Get All Item
    public function displayItem(){
        if ($this->head === null) {
            return "No Items Available.";
        }
        $current = $this->head;
        $itemsOutput = "";
        do {
            $itemsOutput .= "Item: " . $current->itemName . " Quantity: " . $current->quantity . "<br>";
            $current = $current->next;
        } while ($current !== $this->head);

        return $itemsOutput;
    }
}

// Usage of CurculaerItemList
$itemList = new CircularItemList();
$itemList->addItem("Laptop", 10);
$itemList->addItem("Printer", 5);
$itemList->addItem("Scanner", 3);

// Get All Item
echo "Available Items in Warehouse: <br>";
echo $itemList->displayItem();

// Nama: Matthew Alexander Andriyanto
// NIM: 231232025

?>