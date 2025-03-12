<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include "includes/koneksi.php";


$nisn = $_GET['id'];

$query = "SELECT * FROM siswa WHERE nisn = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $nisn);
$stmt->execute();
$result = $stmt->get_result();
$siswa = $result->fetch_assoc();

if (!$siswa) {
    echo "<p>Data siswa tidak ditemukan. Coba kembali lagi ke <a href='login.php'>halaman</a> sebelumnya</p>";
    exit();
}

// Fetch statistics data
$jurusanQuery = "SELECT jurusan, COUNT(*) as count FROM siswa GROUP BY jurusan";
$jurusanResult = $connection->query($jurusanQuery);
$jurusanData = [];
while ($row = $jurusanResult->fetch_assoc()) {
    $jurusanData[] = $row;
}

$kelasQuery = "SELECT kelas, COUNT(*) as count FROM siswa GROUP BY kelas";
$kelasResult = $connection->query($kelasQuery);
$kelasData = [];
while ($row = $kelasResult->fetch_assoc()) {
    $kelasData[] = $row;
}

$genderQuery = "SELECT jenis_kelamin, COUNT(*) as count FROM siswa GROUP BY jenis_kelamin";
$genderResult = $connection->query($genderQuery);
$genderData = [];
while ($row = $genderResult->fetch_assoc()) {
    $genderData[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Siswa</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .upload-form {
            margin-top: 20px;
        }

        .chart-container {
            width: 300px;
            height: 150px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <h1>DETAIL DATA</h1>
    <?php if (!empty($siswa['foto'])): ?>
        <img src="uploads/<?= $siswa['foto'] ?>" alt="Foto Profil" class="profile-pic">
    <?php else: ?>
        <img src="uploads/default.png" alt="Foto Profil" class="profile-pic">
    <?php endif; ?>
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
    <h2>Statistik Siswa</h2>
    <div class="chart-container">
        <canvas id="jurusanChart"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="kelasChart"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="genderChart"></canvas>
    </div>

    <a href="list_data.php">Kembali</a>

    <script>
        // Data for Jurusan Chart
        const jurusanLabels = <?= json_encode(array_column($jurusanData, 'jurusan')) ?>;
        const jurusanCounts = <?= json_encode(array_column($jurusanData, 'count')) ?>;

        // Data for Kelas Chart
        const kelasLabels = <?= json_encode(array_column($kelasData, 'kelas')) ?>;
        const kelasCounts = <?= json_encode(array_column($kelasData, 'count')) ?>;

        // Data for Gender Chart
        const genderLabels = <?= json_encode(array_column($genderData, 'jenis_kelamin')) ?>;
        const genderCounts = <?= json_encode(array_column($genderData, 'count')) ?>;

        // Jurusan Chart
        const ctxJurusan = document.getElementById('jurusanChart').getContext('2d');
        new Chart(ctxJurusan, {
            type: 'bar',
            data: {
                labels: jurusanLabels,
                datasets: [{
                    label: 'Jumlah Siswa per Jurusan',
                    data: jurusanCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Kelas Chart
        const ctxKelas = document.getElementById('kelasChart').getContext('2d');
        new Chart(ctxKelas, {
            type: 'bar',
            data: {
                labels: kelasLabels,
                datasets: [{
                    label: 'Jumlah Siswa per Kelas',
                    data: kelasCounts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gender Chart
        const ctxGender = document.getElementById('genderChart').getContext('2d');
        new Chart(ctxGender, {
            type: 'pie',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Jumlah Siswa per Jenis Kelamin',
                    data: genderCounts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>

</body>

</html>