<?php 
$password = 'rahasia'; 
$salt = 'abc123';
$iterasi = 1000; 
$hash = hash_pbkdf2 ( 'sha256', $password, $salt, $iterasi, 32 ); 
echo $hash;
?>