<?php

$host = 'localhost'; 
$username = 'root';  
$password = '';      
$database = 'sekolahku';
$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Koneksi gagal: " . $connection->connect_error);
} else {
    
}

// Menutup koneksi
$connection->close();

try {
    $connection = mysqli_connect($host, $username, $password, $database);
} catch (Exception $e) { 
    echo "Koneksi database gagal: " . $e->getMessage();
}
?>
