<?php
require 'vendor/autoload.php';

use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

// User Data
$data = [
    ['nama' => 'Jhon', 'umur' => 25, 'penghasilan' => 5000000, 'label' => 1], // Loyal User
    ['nama' => 'Jane', 'umur' => 30, 'penghasilan' => 3000000, 'label' => 0], // Not Loyal User
    ['nama' => 'Bob', 'umur' => 20, 'penghasilan' => 4000000, 'label' => 1], // Not Loyal User
    ['nama' => 'Alice', 'umur' => 35, 'penghasilan' => 6000000, 'label' => 1], // Not Loyal User
    ['nama' => 'Mike', 'umur' => 40, 'penghasilan' => 2000000, 'label' => 0], // Not Loyal User
];

// Data Convertion to SVM Format
$datasets = [];
$labels = [];
foreach ($data as $pelanggan) {
    $datasets[] = [$pelanggan['umur'], $pelanggan['penghasilan']];
    $labels[] = $pelanggan['label'];
}

// Data for training testing
$trainData = array_slice($datasets, 0, 3);
$trainLabels = array_slice($labels, 0, 3);
$testData = $datasets[3];

// Init SVM
$sdk = new SVC(Kernel::RBF, 1000);
$sdk->train($trainData, $trainLabels);

// Prediction
$prediksi = $sdk->predict($testData);

// Prediction Result
echo "Prediksi: " . ($prediksi == 1 ? "Pelanggan Loyal" : "Bukan Pelanggan Loyal");

// Matthew Alexander Andriyanto
// 231232025
?>