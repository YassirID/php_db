<?php
include "includes/koneksi.php";

// Pagination settings
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';
$jurusan = isset($_GET['jurusan']) ? $_GET['jurusan'] : '';
$agama = isset($_GET['agama']) ? $_GET['agama'] : '';
$tahun_lahir = isset($_GET['tahun_lahir']) ? $_GET['tahun_lahir'] : '';

$where_clauses = [];
if ($search) {
    $where_clauses[] = "(nama LIKE '%$search%' OR kelas LIKE '%$search%' OR jurusan LIKE '%$search%')";
}
if ($kelas) {
    $where_clauses[] = "kelas = '$kelas'";
}
if ($jurusan) {
    $where_clauses[] = "jurusan = '$jurusan'";
}
if ($agama) {
    $where_clauses[] = "agama = '$agama'";
}
if ($tahun_lahir) {
    $where_clauses[] = "YEAR(tanggal_lahir) = '$tahun_lahir'";
}

$where_sql = '';
if (count($where_clauses) > 0) {
    $where_sql = 'WHERE ' . implode(' AND ', $where_clauses);
}

$query = "SELECT * FROM siswa $where_sql LIMIT $limit OFFSET $offset";
$count_query = "SELECT COUNT(*) as total FROM siswa $where_sql";

$result = $connection->query($query);
$count_result = $connection->query($count_query);
$total_data = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit);
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
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
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
            background-color: #ffc107;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #0056b3;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        .filter-container select {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filter-container button {
            padding: 10px 20px;
            background-color: #ffc107;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .filter-container button:hover {
            background-color: #0056b3;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }

        .pagination a.active {
            background-color: #0056b3;
            color: white;
        }

        .pagination a:hover {
            background-color: #ffc107;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>

<body>

    <h1>LIST DATA</h1>
    <a href="add_form.php">Tambah Data</a>
    <a href="/system/export.php?format=csv">Export CSV</a>
    <a href="/system/export.php?format=excel">Export Excel</a>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['success']) ?>
        </div>
    <?php endif; ?>

    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari data..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="filter-container">
        <form method="GET" action="">
            <select name="kelas">
                <option value="">Pilih Kelas</option>
                <option value="10" <?= isset($_GET['kelas']) && $_GET['kelas'] == '10' ? 'selected' : '' ?>>10</option>
                <option value="11" <?= isset($_GET['kelas']) && $_GET['kelas'] == '11' ? 'selected' : '' ?>>11</option>
                <option value="12" <?= isset($_GET['kelas']) && $_GET['kelas'] == '12' ? 'selected' : '' ?>>12</option>
            </select>

            <select name="jurusan">
                <option value="">Pilih Jurusan</option>
                <option value="PPLG" <?= isset($_GET['jurusan']) && $_GET['jurusan'] == 'PPLG' ? 'selected' : '' ?>>PPLG</option>
                <option value="AKL" <?= isset($_GET['jurusan']) && $_GET['jurusan'] == 'AKL' ? 'selected' : '' ?>>AKL</option>
                <option value="MPLB" <?= isset($_GET['jurusan']) && $_GET['jurusan'] == 'MPLB' ? 'selected' : '' ?>>MPLB</option>
                <option value="PM" <?= isset($_GET['jurusan']) && $_GET['jurusan'] == 'PM' ? 'selected' : '' ?>>PM</option>
            </select>

            <select name="agama">
                <option value="">Pilih Agama</option>
                <option value="Islam" <?= isset($_GET['agama']) && $_GET['agama'] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= isset($_GET['agama']) && $_GET['agama'] == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= isset($_GET['agama']) && $_GET['agama'] == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= isset($_GET['agama']) && $_GET['agama'] == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= isset($_GET['agama']) && $_GET['agama'] == 'Budha' ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= isset($_GET['agama']) && $_GET['agama'] == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
            </select>

            <select name="tahun_lahir">
                <option value="">Pilih Tahun Lahir</option>
                <?php
                $current_year = date('Y');
                for ($year = $current_year; $year >= 1980; $year--) {
                    echo "<option value=\"$year\" " . (isset($_GET['tahun_lahir']) && $_GET['tahun_lahir'] == $year ? 'selected' : '') . ">$year</option>";
                }
                ?>
            </select>

            <button type="submit">Filter</button>
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
                <td><?= $nomor + 1 + $offset ?></td>
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

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <a href="?page=<?= $i ?>&limit=<?= $limit ?>&search=<?= htmlspecialchars($search) ?>&kelas=<?= htmlspecialchars($kelas) ?>&jurusan=<?= htmlspecialchars($jurusan) ?>&agama=<?= htmlspecialchars($agama) ?>&tahun_lahir=<?= htmlspecialchars($tahun_lahir) ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>

</body>

</html>

