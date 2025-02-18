<?php
include 'koneksi.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM siswa WHERE nama LIKE '%$search%' OR kelas LIKE '%$search%' OR jurusan LIKE '%$search%'";
} else {
    $query = "SELECT * FROM siswa";
}

$result = $connection->query($query);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Data</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        a {
            margin-bottom: 10px;
        }

        .aksi {
            text-align: center;
            width: 200px;
        }

        .aksi a {
            margin-top: 10px;
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
            /* Nama animasi, durasi, dan jenis animasi */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                /* Awalnya transparan */
            }

            to {
                opacity: 1;
                /* Akhirnya terlihat penuh */
            }
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-container button {
            padding: 10px 20px;
            background-color:#ffc107;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <h1>LIST DATA</h1>
    <a href="add_form.php">Tambah Data</a>

    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari data..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <table class="fade-in">
        <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>NAMA</th>
            <th>KELAS</th>
            <th>JURUSAN</TH>
            <th class="aksi">AKSI</TH>
        </tr>
        </thead>

        <?php
        foreach ($result as $nomor => $siswa) : ?>
            <tr>
                <td><?= $nomor + 1 ?></td>
                <td><?= $siswa['nisn'] ?></td>
                <td><a href="profile.php?id=<?= $siswa['nisn'] ?>"><?= $siswa['nama'] ?></a> </td>
                <td><?= $siswa['kelas'] ?></td>
                <td><?= $siswa['jurusan'] ?></td>
                <td class="aksi">
                    <a href="edit.php?id=<?= $siswa['nisn'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $siswa['nisn'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>