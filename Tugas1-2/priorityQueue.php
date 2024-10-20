<?php
class PriotiryQueue{
    private $items = [];
    public function enqueue($item, $priority){
        $this->items[] = ["item" => $item,"priority"=> $priority];
        usort( $this->items, function($a, $b){
            return $b["priority"] - $a["priority"];
        } );
    }

    public function dequeue(){
        return array_shift( $this->items )['item'];
    }

    public function isEmpty(){
        return empty( $this->items );
    }
}

// Penggunaan
$priorityQueue = new PriotiryQueue();
$priorityQueue->enqueue("Alexander", 1);
$priorityQueue->enqueue("Matthew", 2);
echo $priorityQueue->dequeue() . "<br>";
?>