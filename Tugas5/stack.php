<?php

class Stack{
    private $stack;
    private $limit;

    public function __construct($limit = 10){
        $this->stack = [];
        $this->limit = $limit;
    }

    public function push($item){
        if(count($this->stack) < $this->limit){
            array_push($this->stack, $item);
        } else{
            echo "Stack penuh, tidak bisa menambahkan perubahan <br>";
        }
    }

    public function pop(){
        if($this->isEmpty()){
            return "Tidak ada yang bisa di-undo";
        } else{
            return array_pop($this->stack);
        }
    }

    public function peek(){
        return end($this->stack);
    }

    public function isEmpty(){
        return empty($this->stack);
    }

}

// Stack for undo and redo opperation
$undoStack = new Stack(10);
$redoStack = new Stack(10);

// Edit picture simulation
function addEditAction($stack, $action){
    $stack->push($action);
}

// Undo function
function undoAction($undoStack, $redoStack){
    $lastAction = $undoStack->pop();
    if($lastAction != "Tidak ada yang bisa di-undo."){
        echo "Undo action: " . $lastAction["action"] . " at " . $lastAction['time'] . "<br>";
        $redoStack->push($lastAction);
    } else{
        echo $lastAction . "<br>";
    }
}

// Redo Function
function redoAction($redoStack, $undoStack){
    $lastRedo = $redoStack->pop();
    if($lastRedo != "Tidak ada yang bisa di-undo."){
        echo "Redo action: " . $lastRedo["action"] . " at " . $lastRedo["time"] . "<br>";
        $undoStack->push($lastRedo);
    } else{
        echo $lastRedo . "<br>";
    }
}

// Add some edit picture action
addEditAction($undoStack, ["action" => "filter", "time" => "2024-10-26 10:00:00"]);
addEditAction($undoStack, ["action" => "crop", "time" => "2024-10-26 10:05:00"]);
addEditAction($undoStack, ["action" => "rotate", "time" => "2024-10-26 10:10:00"]);

// Undo and Redo
undoAction($undoStack, $redoStack); // Undo Rotate
undoAction($undoStack, $redoStack); // Undo Crop
redoAction($redoStack, $undoStack); // Redo Crop

echo "<br> Matthew Alexander Andriyanto <br> 231232025"

?>