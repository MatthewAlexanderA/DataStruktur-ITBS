<?php
class Queue{
    private $items = [];
    public function enqueue($item){
        $this->items[] = $item;
    }

    public function dequeue(){
        return array_shift( $this->items );
    }

    public function peek(){
        return $this->items[0] ?? null;
    }

    public function isEmpty(){
        return empty( $this->items );
    }
}

// Penggunaan
$queue = new Queue();
$queue->enqueue("Matthew");
$queue->enqueue("Alexander");
echo $queue->peek() . "<br>";
$queue->dequeue();
echo $queue->peek() . "<br>";
?>