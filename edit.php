<?php
include 'koneksi.php';

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
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="">
  <style>
    /* ... (Gaya CSS tabel Anda sebelumnya) ... */

    /* Gaya untuk formulir tambah data */
    body {
      font-family: "Roboto", sans-serif;
      margin: 20px;
      background: linear-gradient(to right, #e0eafc, #cfdef3);
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


    h3 {
      text-align: center;
      margin-bottom: 20px;
      color: #343a40;
      /* Warna judul */
    }

    form {
      width: 50%;
      /* Lebar formulir */
      margin: 20px auto;
      /* Tengahkan formulir */
      padding: 20px;
      border: 1px solid #ced4da;
      /* Garis batas formulir */
      border-radius: 5px;
      /* Sudut tumpul */
      background-color: #f8f9fa;
      /* Latar belakang formulir */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      /* Efek bayangan */
    }

    label {
      display: block;
      /* Label di atas input */
      margin-bottom: 5px;
      color: #343a40;
      /* Warna label */
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      box-sizing: border-box;
      /* Lebar input termasuk padding dan border */
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
      /* Hilangkan garis bawah pada link */
    }

    button[type="submit"] {
      background-color: #007bff;
      /* Warna tombol submit */
      color: white;
    }

    a {
      background-color: #ffc107;
      /* Warna tombol kembali */
      color: white;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
      /* Warna hover tombol submit */
      transform: scale(1.02);
    }

    a:hover {
      background-color: #535a5e;
      /* Warna hover tombol kembali */
      transform: scale(1.02);
    }
  </style>
</head>

<body class="fade-in">
  <h3>TAMBAH DATA SISWA</h3>
  <form action="update.php" method="post">
    <label for="">Nis</label>
    <input type="text" name="nisn"
      required value="<?= $siswa['nisn'] ?>">

    <br><br>

    <label for="">Nama</label>
    <input type="text" name="nama"
      required value="<?= $siswa['nama'] ?>">

    <br><br>

    <label for="">Kelas</label>
    <input type="text" name="kelas"
      required value="<?= $siswa['kelas'] ?>">

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

    <input type="radio" name="jenis_kelamin" value="laki-laki" id="laki-laki" required
      <?= ($siswa['jenis_kelamin'] == "laki-laki") ? "checked" : ""; ?>>
    <label for="laki-laki">Laki-laki</label>

    <input type="radio" name="jenis_kelamin" value="perempuan" id="perempuan"
      <?= ($siswa['jenis_kelamin'] == "perempuan") ? "checked" : ""; ?>>
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

    <button type="submit">Tambah</button>
    <a href="list_data.php">Kembali</a>
  </form>
</body>

</html>