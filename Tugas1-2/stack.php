<?php
class Stack{
    private $items = [];
    public function push($item){
        $this->items[] = $item;
    }

    public function pop(){
        return array_pop( $this->items );
    }

    public function peek(){
        return end( $this->items );
    }

    public function isEmpty(){
        return empty( $this->items );
    }
}

// Penggunaan
$stack = new Stack();
$stack->push("Matthew");
$stack->push("Alexander");
echo $stack->peek() . "<br>";
$stack->pop();
echo $stack->peek() . "<br>";
?>