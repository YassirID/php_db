<?php
include "includes/koneksi.php";

$format = isset($_GET['format']) ? $_GET['format'] : 'csv';

$query = "SELECT * FROM siswa";
$result = $connection->query($query);

if ($format == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=data_siswa.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('NIS', 'Nama', 'Kelas', 'Jurusan', 'Jenis Kelamin', 'Tanggal Lahir', 'Tempat Lahir', 'Agama', 'Alamat'));

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
} elseif ($format == 'excel') {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=data_siswa.xls');

    echo "NIS\tNama\tKelas\tJurusan\tJenis Kelamin\tTanggal Lahir\tTempat Lahir\tAgama\tAlamat\n";

    while ($row = $result->fetch_assoc()) {
        echo implode("\t", $row) . "\n";
    }
}

$connection->close();
?>