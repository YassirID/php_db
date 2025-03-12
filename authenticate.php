<?php
session_start();
include "includes/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['nisn'] = $user['nisn'];
    
    if ($user['role'] == 'siswa') {
        header("Location: profile.php?id=" . $user['nisn']);
    } else {
        header("Location: list_data.php");
    }
} else {
    header("Location: login.php?error=Invalid credentials");
}
?>