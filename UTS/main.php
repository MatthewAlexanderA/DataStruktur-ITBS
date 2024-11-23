<?php
class SensorQueue {
    private $queue = [];

    // Add new sensor data (enqueue)
    public function enqueue($sensorID, $data, $readTime) {
        $sensorData = [
            'sensorID' => $sensorID,
            'data' => $data,
            'readTime' => $readTime
        ];
        array_push($this->queue, $sensorData);
        echo "Sensor ID: $sensorID, Data: $data, Waktu Baca: $readTime telah ditambahkan ke antrian.<br>";
    }

    // Delete oldest data (dequeue)
    public function dequeue() {
        if (empty($this->queue)) {
            echo "Queue kosong, tidak ada data untuk dihapus.<br>";
            return null;
        }
        $removedSensor = array_shift($this->queue);
        echo "Sensor ID: {$removedSensor['sensorID']} telah dihapus dari antrian.<br>";
        return $removedSensor;
    }

    // Show next data that will be process (peek)
    public function peek() {
        if (empty($this->queue)) {
            echo "Queue kosong, tidak ada data untuk diproses.<br>";
            return null;
        }
        $nextSensor = $this->queue[0];
        echo "Sensor ID: {$nextSensor['sensorID']} akan diproses berikutnya.<br>";
        return $nextSensor;
    }

    // Show all queue
    public function displayQueue() {
        if (empty($this->queue)) {
            echo "Queue kosong.<br>";
        } else {
            echo "Data Sensor dalam Antrian:<br>";
            foreach ($this->queue as $sensor) {
                echo "Sensor ID: {$sensor['sensorID']}, Data: {$sensor['data']}, Waktu Baca: {$sensor['readTime']}<br>";
            }
        }
    }
}

// Usage
$sensorQueue = new SensorQueue();

// Add new data
$sensorQueue->enqueue(1, "Data Sensor A", "2024-11-23 08:00");
$sensorQueue->enqueue(2, "Data Sensor B", "2024-11-23 08:10");
$sensorQueue->enqueue(3, "Data Sensor C", "2024-11-23 08:20");

// Show next data that will be process (peek)
$sensorQueue->peek();

// Show all data in queue
$sensorQueue->displayQueue();

// Delete the oldest data (dequeue)
$sensorQueue->dequeue();

// Show all data in queue
$sensorQueue->displayQueue();

// Matthew Alexander Andriyanto
// 231232025

?>
