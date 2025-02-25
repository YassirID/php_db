<?php
include "../includes/koneksi.php";

$nis = $_GET["id"];

try {
    $connection->query ( "DELETE FROM siswa WHERE nisn = '$nis'");

    header ("location: ../list_data.php");
} catch (exception $e) {
    echo "hapus data gagal : " . $e->getMessage();
    }

?>