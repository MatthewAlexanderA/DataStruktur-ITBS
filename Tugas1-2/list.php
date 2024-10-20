<?php
class ArrayList{
    private $items = [];
    public function add($item){
        $this->items[] = $item;
    }

    public function get($index){
        return $this->items[$index] ?? null;
    }

    public function size(){
        return count($this->items);
    }

    public function remove($index){
        if(isset($this->items[$index])){
            array_splice($this->items, $index,1);
        }
    }

    public function display(){
        return $this->items;
    }
}

// Penggunaan
$list = new ArrayList();
$list->add("Matthew");
$list->add("Alexander");
echo implode(",", $list->display()) . "<br>";
$list->remove(0);
echo implode(",", $list->display()) . "<br>";
?>