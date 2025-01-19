<?php 
$password = 'rahasia '; // Password asli 
$salt = 'abc123 '; // Nilai tambahan ( salt ) 
$iterasi = 1000 ; // Jumlah pengulangan ( iterasi ) 
$hash = hash_pbkdf2( 'sha256', $password, $salt, $iterasi, 32 ) ; // Menghasilkan hash 
echo $hash ; // Menampilkan hash hasil
?>