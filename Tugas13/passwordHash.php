<?php
$data = "rahasia"; 
$hash = password_hash($data, PASSWORD_DEFAULT); 
echo $hash;

// Verifikasi password 
$verifikasi = password_verify($data, $hash); 
echo "<br>";
echo $verifikasi ? "Benar" : "Salah ";
?>