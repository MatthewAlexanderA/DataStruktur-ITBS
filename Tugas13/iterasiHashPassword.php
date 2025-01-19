<?php 
// Fungsi untuk menghasilkan hash password 
function hash_password($password, $salt, $iterasi) { 
    $hash = hash_pbkdf2('sha256', $password, $salt, $iterasi, 32);
    return $hash;
} 

// Input password 
$password = 'rahasia';

// Input salt 
$salt = 'abc123';

// Input iterasi 
$iterasi = 1000;

// Menghasilkan hash password 
$hash_password = hash_password($password, $salt, $iterasi);

// Menampilkan hasil 
echo " Password : $password <br>";
echo " Salt : $salt <br>";
echo " Iterasi : $iterasi <br>";
echo " Hash Password : $hash_password <br>";
?>