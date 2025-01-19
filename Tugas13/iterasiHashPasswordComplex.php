<?php 
// Fungsi untuk menghasilkan hash password 
function hash_password($password, $salt, $iterasi) { 
    $hash = hash_pbkdf2('sha256', $password, $salt, $iterasi, 32);
    return $hash;
} 

// Fungsi untuk memeriksa kekuatan password 
function check_password_strength($password) { 
    $strength = 0; 
    if(strlen($password )>= 8 ) $strength++; 
    if(preg_match("/[A-Z]/", $password)) $strength++; 
    if(preg_match("/[a-z]/", $password)) $strength++; 
    if(preg_match("/[0-9]/", $password)) $strength++; 
    if(preg_match("/[!@#$%^&*()_+=;:'<>\/?,-]/", $password)) $strength++; 
    return $strength; 
} 

// Fungsi untuk menghasilkan salt acak 
function generate_salt() { 
    $salt = bin2hex(random_bytes(16)); 
    return $salt; 
}

// Cek apakah form disubmit 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan password dan iterasi ada
    if (isset($_POST['password']) && isset($_POST['iterasi'])) {
        $password = $_POST['password'];
        $iterasi = (int)$_POST['iterasi'];  // Pastikan iterasi adalah integer

        // Validasi iterasi (harus lebih besar dari 0)
        if ($iterasi > 0) {
            // Menghasilkan salt acak 
            $salt = generate_salt(); 

            // Menghasilkan hash password 
            $hash_password = hash_password($password, $salt, $iterasi);

            // Memeriksa kekuatan password 
            $strength = check_password_strength($password); 

            // Menampilkan hasil 
            echo "Password : $password <br>"; 
            echo "Salt : $salt <br>"; 
            echo "Iterasi : $iterasi <br>"; 
            echo "Hash Password : $hash_password <br>"; 
            echo "Kekuatan Password : $strength/5 <br>"; 

            // Simpan ke database ( contoh ) 
            $db = array( 
                'password'=> $hash_password, 
                'salt'=> $salt, 
                'iterasi'=> $iterasi, 
                'kekuatan'=> $strength 
            );
            file_put_contents('database.json', json_encode($db));
        } else {
            echo "Error: Iterasi harus lebih besar dari 0.";
        }
    } else {
        echo "Error: Semua field harus diisi.";
    }
}
?>

<html>
    <body>
        <!-- Form input --> 
        <form action="" method="post"> 
            <label> Password : </label> 
            <input type="password" name="password" required> <br> <br> 
            <label> Iterasi : </label> 
            <input type="number" name="iterasi" required> <br> <br> 
            <input type="submit" value="Hash"> 
        </form>
    </body>
</html>
