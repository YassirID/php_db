<?php 
include "koneksi.php";

$nis = $_POST["nisn"];
$nama = $_POST["nama"];
$kelas = $_POST["kelas"];
$jurusan = $_POST["jurusan"];
$tempat_lahir = $_POST["tempat_lahir"];
$tanggal_lahir = $_POST["tanggal_lahir"];
$jenis_kelamin = $_POST["jenis_kelamin"];
$agama = $_POST["agama"];
$alamat = $_POST["alamat"];

try {
    $connection -> query ("INSERT INTO siswa (nisn, nama, kelas, jurusan, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat) VALUE ('$nis', '$nama', '$kelas', '$jurusan', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$alamat')");

    header ("location: list_data.php");
} catch (exception $e) {
    echo "tambah data gagal : " . $e->getMessage();
    }

?>
