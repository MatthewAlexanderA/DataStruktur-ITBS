<?php
$data = "Hello World!"; 
$kunci = "rahasia"; 
$hash = hash_hmac('sha256', $data, $kunci); 
echo $hash;
?>