<?php
// Data transaksi: setiap transaksi merupakan array item
$transactions = [
    ['susu', 'roti', 'keju'],
    ['roti', 'keju'],
    ['susu', 'roti'],
    ['roti', 'keju'],
    ['susu', 'keju'],
];
$minSupport = 0.6;
$totalTransactions = count($transactions);

// Fungsi untuk menghitung support suatu itemset
function countSupport($transactions, $itemset) {
    $count = 0;
    foreach ($transactions as $trans) {
        if (count(array_intersect($trans, $itemset)) == count($itemset)) {
            $count++;
        }
    }
    return $count / count($transactions);
}

// Mendapatkan frequent 1-itemset
function apriori1Itemset($transactions, $minSupport) {
    $itemCounts = [];
    foreach ($transactions as $trans) {
        foreach ($trans as $item) {
            if (!isset($itemCounts[$item])) {
                $itemCounts[$item] = 0;
            }
            $itemCounts[$item]++;
        }
    }
    $frequent1 = [];
    foreach ($itemCounts as $item => $count) {
        $support = $count / count($transactions);
        if ($support >= $minSupport) {
            $frequent1[$item] = $support;
        }
    }
    return $frequent1;
}

// Mendapatkan kandidat 2-itemset dari frequent 1-itemset
function generateCandidates($frequent1) {
    $items = [];
    foreach ($frequent1 as $itemset => $support) {
        // $itemset adalah array yang diconvert ke string saat key, kembalikan ke array
        $items[] = current(explode(',', $itemset));
    }
    $candidates = [];
    $n = count($items);
    for ($i = 0; $i < $n; $i++) {
        for ($j = $i+1; $j < $n; $j++) {
            $candidate = [$items[$i], $items[$j]];
            sort($candidate);
            $candidates[] = $candidate;
        }
    }
    return $candidates;
}

// Evaluasi frequent 2-itemset
function apriori2Itemset($transactions, $candidates, $minSupport) {
    $frequent2 = [];
    foreach ($candidates as $candidate) {
        $support = countSupport($transactions, $candidate);
        if ($support >= $minSupport) {
            $frequent2[implode(',', $candidate)] = $support;
        }
    }
    return $frequent2;
}

$frequent1 = apriori1Itemset($transactions, $minSupport);
$candidates2 = generateCandidates($frequent1);
$frequent2 = apriori2Itemset($transactions, $candidates2, $minSupport);

echo "Frequent 1-itemsets:<br>";
print_r($frequent1);
echo "<br>Frequent 2-itemsets:<br>";
print_r($frequent2);

/*
Analisis:
- Proses frequent 1-itemset: O(n * k) dengan n transaksi dan k item rata-rata per transaksi.
- Proses kandidat 2-itemset: O(m^2) dengan m item unik.
- Support dihitung untuk tiap kandidat dengan proses iteratif.
*/

// Matthew Alexander Andriyanto
// 231232025
?>