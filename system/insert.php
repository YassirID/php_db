<?php
include 'includes/koneksi.php';

$nisn = $_POST['nisn'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$tempat_lahir = $_POST['tempat_lahir'];
$agama = $_POST['agama'];
$alamat = $_POST['alamat'];

$errors = [];

if (empty($nisn) || !is_numeric($nisn)) {
    $errors[] = "NIS harus diisi dan berupa angka.";
}

if (empty($nama)) {
    $errors[] = "Nama harus diisi.";
}

if (empty($kelas)) {
    $errors[] = "Kelas harus diisi.";
}

if (empty($jurusan)) {
    $errors[] = "Jurusan harus dipilih.";
}

if (empty($jenis_kelamin)) {
    $errors[] = "Jenis kelamin harus dipilih.";
}

if (empty($tanggal_lahir)) {
    $errors[] = "Tanggal lahir harus diisi.";
}

if (empty($tempat_lahir)) {
    $errors[] = "Tempat lahir harus diisi.";
}

if (empty($agama)) {
    $errors[] = "Agama harus dipilih.";
}

if (empty($alamat)) {
    $errors[] = "Alamat harus diisi.";
}

if (count($errors) > 0) {
    $error_message = implode('<br>', $errors);
    header("Location: list_data.php?error=" . urlencode($error_message));
    exit;
}

$query = "INSERT INTO siswa (nisn, nama, kelas, jurusan, jenis_kelamin, tanggal_lahir, tempat_lahir, agama, alamat) VALUES ('$nisn', '$nama', '$kelas', '$jurusan', '$jenis_kelamin', '$tanggal_lahir', '$tempat_lahir', '$agama', '$alamat')";

if ($connection->query($query) === TRUE) {
    header("Location: list_data.php?success=Data berhasil ditambahkan.");
} else {
    header("Location: list_data.php?error=" . urlencode("Error: " . $query . "<br>" . $connection->error));
}

$connection->close();
?>