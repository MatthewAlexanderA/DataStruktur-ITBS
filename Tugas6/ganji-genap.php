<?php
for ($i = 1; $i <= 1000; $i++) {
    if (($i - 1) / 100 % 2 == 0) {
        if ($i % 2 != 0) { 
            echo "Bilangan ganjil: $i<br>";
        } 
        // echo ($i - 1) / 100 % 2;
    } 
    else {
        if ($i % 2 == 0) { 
            echo "Bilangan genap: $i<br>";
        }
        // echo ($i - 1) / 100 % 2;
    }
}
?>
