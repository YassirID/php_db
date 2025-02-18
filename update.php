<?php
include 'koneksi.php';

$nisn = $_POST['nisn'];  
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$tempat_lahir = $_POST['tempat_lahir'];
$agama = $_POST['agama'];
$alamat = $_POST['alamat'];


try {
    $connection->query( "UPDATE siswa SET nisn = '$nisn', nama = '$nama', kelas = '$kelas', jurusan = '$jurusan', jenis_kelamin = '$jenis_kelamin', tanggal_lahir  = '$tanggal_lahir', tempat_lahir = '$tempat_lahir', agama = '$agama', alamat = '$alamat' WHERE nisn = '$nisn'");
    header("location: list_data.php");
}
catch (exception $e) {
    echo "update data gagal : " . $e->getMessage();
}

