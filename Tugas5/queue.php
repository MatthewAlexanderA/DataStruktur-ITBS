<?php

class Queue{
    private $queue;
    private $limit;

    public function __construct($limit = 20){
        $this->queue = [];
        $this->limit = $limit;
    }

    public function enqueue($item){
        if(count($this->queue) < $this->limit){
            array_push($this->queue, $item);
        } else{
            echo "Queue penuh, tidak bisa menambahkan data. <br>";
        }
    }

    public function dequeue(){
        if($this->isEmpty()){
            return "Queue kosong, tidak ada data untuk diproses.";
        } else{
            return array_shift($this->queue);
        }
    }

    public function front(){
        return reset($this->queue);
    }

    public function rear(){
        return end($this->queue);
    }

    public function isEmpty(){
        return empty($this->queue);
    }
}

// Queue for IoT data
$iotDataQueue = new Queue(20);

// Get data function from IoT
function receiveIoTData($queue, $data){
    echo "Menerima data Iot: " . $data . "<br>";
    $queue->enqueue($data);
}

// Function for processing data with batch
function processIoTData($queue, $batchSize){
    $batch = [];
    for($i = 0; $i < $batchSize; $i++){
        if(!$queue->isEmpty()){
            $batch[] = $queue->dequeue();
        } else{
            break;
        }
    }
    echo "Processing batch data: " . implode(",", $batch) . "<br>";
}

// Get data from IoT simulation
receiveIoTData($iotDataQueue, "Temperature: 22C");
receiveIoTData($iotDataQueue, "Humidity: 45%");
receiveIoTData($iotDataQueue, "Light: 350 Lux");

// Process data in batch (size 2)
processIoTData($iotDataQueue, "2");

// Show data in front and rear queue
echo "Front of Queue: " . $iotDataQueue->front() . "<br>";
echo "Rear of Queue: " . $iotDataQueue->rear() . "<br>";

echo "<br> Matthew Alexander Andriyanto <br> 231232025"

?>