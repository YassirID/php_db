<?php
include "includes/koneksi.php";

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$nisn = $_POST['nisn'];
$role = $_POST['role'];

// Periksa apakah NISN sudah ada di database siswa
$query = "SELECT * FROM siswa WHERE nisn = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $nisn);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: register.php?error=NISN tidak ditemukan di database siswa");
    exit();
}

// Simpan data pengguna baru
$query = "INSERT INTO users (username, password, role, nisn) VALUES (?, ?, ?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("ssss", $username, $password, $role, $nisn);

if ($stmt->execute()) {
    header("Location: login.php?success=User registered successfully");
} else {
    header("Location: register.php?error=Failed to register user");
}
?>