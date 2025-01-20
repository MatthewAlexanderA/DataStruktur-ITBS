<?php
class KMeanClustering{
    private $data;
    private $centroid;
    private $cluster;
    private $k;

    public function __construct($data, $k){
        $this->data = $data;
        $this->k = $k;
        $this->centroid = array();
        $this->cluster = array();
    }

    public function initCentroid(){
        for($i = 0; $i < $this->k; $i++){
            $this->centroid[] = $this->data[rand(0, count($this->data) - 1)];
        }
    }

    public function assignCluster(){
        foreach($this->data as $point){
            $minDistance = INF;
            $clusterIndex = -1;
            foreach($this->centroid as $index => $centroid){
                $distance = $this->calculateDistance($point, $centroid);
                if($distance < $minDistance){
                    $minDistance = $distance;
                    $clusterIndex = $index;
                }
            }
            $this->cluster[$clusterIndex][] = $point;
        }
    }

    public function updateCentroid(){
        foreach($this->cluster as $index => $cluster){
            $sumX = 0;
            $sumY = 0;
            foreach($cluster as $point){
                $sumX += $point[0];
                $sumY += $point[1];
            }
            $this->centroid[$index] = array($sumX / count($cluster), $sumY / count($cluster));
        }
    }

    public function calculateDistance($point1, $point2){
        return sqrt(pow($point1[0] - $point2[0], 2) + pow($point1[1] - $point2[1], 2));
    }

    public function run(){
        $this->initCentroid();
        while(true){
            $this->assignCluster();
            $oldCentroid = $this->centroid;
            $this->updateCentroid();
            if($this->centroid == $oldCentroid){
                break;
            }
        }
        return $this->cluster;
    }
}

// Data example
$data = array(
    array(1, 2),
    array(2, 1),
    array(3, 3),
    array(4, 4),
    array(5, 5),
    array(6, 6),
    array(7, 7),
    array(8, 8),
    array(9, 9)
);

$k = 3;

$kMean = new KMeanClustering($data, $k);
$cluster = $kMean->run();

print_r($cluster);

// Matthew Alexander Andriyanto
// 231232025
?>