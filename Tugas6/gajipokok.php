<?php 
$pajak = 15/100;
$tunjangan = 20/100;
$gajiPokok = 5000000;

$gajiKaryawan = $gajiPokok + ($gajiPokok * $tunjangan) - ($gajiPokok * $pajak);
echo $gajiKaryawan;

?>