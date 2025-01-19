<?php
$data = 'Hello World!'; 
$kunci = 'rahasia';

// SHA - 256 
$hash_sha256 = hash('sha256', $data); 
echo $hash_sha256; 

// HMAC - SHA - 256 
$hash_hmac_sha256 = hash_hmac('sha256', $data, $kunci); 
echo $hash_hmac_sha256; 

// PBKDF2 
$hash_pbkdf2 = hash_pbkdf2('sha256', 'password', $kunci, 1000, 32); 
echo $hash_pbkdf2;
?>