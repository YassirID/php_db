<?php
include "koneksi.php";

$nis = $_GET["id"];

$query = "SELECT * FROM siswa WHERE nisn = '$nis'";
$result = $connection->query($query);
$siswa = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #007BFF;
        }
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f1f1f1;
        }
        td:first-child {
            font-weight: bold;
            text-align: left;
        }
        td:nth-child(2) {
            font-weight: bold;
            color: #007BFF;
            text-align: center;
        }
        td:last-child {
            text-align: left;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s, transform 0.2s;
        }
        a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

    </style>
</head>

<body>

    <h1>DETAIL DATA</h1>
    <table>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td><?php echo $siswa["nisn"]; ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?php echo $siswa["nama"]; ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?php echo $siswa["kelas"]; ?></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td>:</td>
            <td><?php echo $siswa["jurusan"]; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?php echo $siswa["jenis_kelamin"]; ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><?php echo $siswa["tanggal_lahir"]; ?></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><?php echo $siswa["tempat_lahir"]; ?></td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td><?php echo $siswa["agama"]; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $siswa["alamat"]; ?></td>
        </tr>
    </table>
        <a href="list_data.php">kembali</a>
</body>

</html>