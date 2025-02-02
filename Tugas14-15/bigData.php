<?php
// Simulasi data transaksi (kategori, nilai penjualan)
$transactions = [
    ['kategori' => 'Elektronik', 'nilai' => 100],
    ['kategori' => 'Pakaian', 'nilai' => 50],
    ['kategori' => 'Elektronik', 'nilai' => 200],
    ['kategori' => 'Makanan', 'nilai' => 30],
    ['kategori' => 'Pakaian', 'nilai' => 70],
    ['kategori' => 'Makanan', 'nilai' => 45]
];

// Fungsi Mapper: mengelompokkan data per kategori
function mapper($transactions) {
    $mapped = [];
    foreach ($transactions as $trans) {
        $key = $trans['kategori'];
        $value = $trans['nilai'];
        if (!isset($mapped[$key])) {
            $mapped[$key] = [];
        }
        $mapped[$key][] = $value;
    }
    return $mapped;
}

// Fungsi Reducer: menjumlahkan nilai per kategori
function reducer($mappedData) {
    $reduced = [];
    foreach ($mappedData as $key => $values) {
        $reduced[$key] = array_sum($values);
    }
    return $reduced;
}

// Simulasi MapReduce
$mappedData = mapper($transactions);
$reducedData = reducer($mappedData);

echo "Total Penjualan per Kategori:<br>";
foreach ($reducedData as $kategori => $total) {
    echo "$kategori: $total<br>";
}

/*
Analisis:
- Mapper: Proses O(n) pada jumlah transaksi.
- Reducer: Proses O(m) pada jumlah kategori unik.
- Total simulasi MapReduce memungkinkan pemrosesan data besar dengan distribusi kerja.
*/

// Matthew Alexander Andriyanto
// 231232025
?>