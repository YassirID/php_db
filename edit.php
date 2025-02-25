<?php
include 'includes/koneksi.php';

$nisn = $_GET['id'];

$query = "SELECT * FROM siswa WHERE nisn = '$nisn'";
$result = $connection->query($query);
$siswa = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Siswa</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="">
  <style>
    body {
      font-family: "Roboto", sans-serif;
      margin: 20px;
      background: linear-gradient(to right, #e0eafc, #cfdef3);
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

    h3 {
      text-align: center;
      margin-bottom: 20px;
      color: #343a40;
    }

    form {
      width: 50%;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      background-color: #f8f9fa;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #343a40;
    }

    input[type="text"],
    select,
    input[type="date"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      box-sizing: border-box;
    }

    button[type="submit"],
    a {
      padding: 10px 15px;
      margin: 5px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
      text-decoration: none;
    }

    button[type="submit"] {
      background-color: #007bff;
      color: white;
    }

    a {
      background-color: #ffc107;
      color: white;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
      transform: scale(1.02);
    }

    a:hover {
      background-color: #535a5e;
      transform: scale(1.02);
    }
  </style>
</head>

<body class="fade-in">
  <h3>EDIT DATA SISWA</h3>
  <form action="system/update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="nisn" value="<?= $siswa['nisn'] ?>">

    <label for="nama">Nama</label>
    <input type="text" name="nama" required value="<?= $siswa['nama'] ?>">

    <br><br>

    <label for="kelas">Kelas</label>
    <input type="text" name="kelas" required value="<?= $siswa['kelas'] ?>">

    <br><br>

    <label for="jurusan">Jurusan</label>
    <select name="jurusan" id="jurusan" required>
      <option value="" disabled <?= empty($siswa['jurusan']) ? "selected" : ''; ?>>Pilih Jurusan</option>
      <option value="PPLG" <?= ($siswa['jurusan'] == "PPLG") ? "selected" : ""; ?>>PPLG</option>
      <option value="AKL" <?= ($siswa['jurusan'] == "AKL") ? "selected" : ""; ?>>AKL</option>
      <option value="MPLB" <?= ($siswa['jurusan'] == "MPLB") ? "selected" : ""; ?>>MPLB</option>
      <option value="PM" <?= ($siswa['jurusan'] == "PM") ? "selected" : ""; ?>>PM</option>
    </select>

    <br><br>

    <label for="jenis_kelamin">Jenis Kelamin</label><br>
    <input type="radio" name="jenis_kelamin" value="laki-laki" id="laki-laki" required <?= ($siswa['jenis_kelamin'] == "laki-laki") ? "checked" : ""; ?>>
    <label for="laki-laki">Laki-laki</label>
    <input type="radio" name="jenis_kelamin" value="perempuan" id="perempuan" <?= ($siswa['jenis_kelamin'] == "perempuan") ? "checked" : ""; ?>>
    <label for="perempuan">Perempuan</label>

    <br><br>

    <label for="tanggal_lahir">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" required value="<?= $siswa['tanggal_lahir'] ?>">
    <br><br>

    <label for="tempat_lahir">Tempat Lahir</label>
    <input type="text" name="tempat_lahir" required value="<?= $siswa['tempat_lahir'] ?>">
    <br><br>

    <label for="agama">Agama</label>
    <select name="agama" id="agama" required>
      <option value="" disabled <?= empty($siswa['agama']) ? 'selected' : ''; ?>>Pilih Agama</option>
      <option value="Islam" <?= ($siswa['agama'] == "Islam") ? "selected" : ""; ?>>Islam</option>
      <option value="Kristen" <?= ($siswa['agama'] == "Kristen") ? "selected" : ""; ?>>Kristen</option>
      <option value="Katolik" <?= ($siswa['agama'] == "Katolik") ? "selected" : ""; ?>>Katolik</option>
      <option value="Hindu" <?= ($siswa['agama'] == "Hindu") ? "selected" : ""; ?>>Hindu</option>
      <option value="Budha" <?= ($siswa['agama'] == "Budha") ? "selected" : ""; ?>>Budha</option>
      <option value="Konghucu" <?= ($siswa['agama'] == "Konghucu") ? "selected" : ""; ?>>Konghucu</option>
    </select>

    <br><br>

    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="alamat" cols="30" rows="10" required><?= $siswa['alamat'] ?></textarea>
    <br><br>

    <label for="foto">Foto Profil</label>
    <input type="file" name="foto" accept="image/*">
    <br><br>

    <button type="submit">Update</button>
    <a href="list_data.php">Kembali</a>
  </form>
</body>

</html>