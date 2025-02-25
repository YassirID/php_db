<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="add.css">
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
  <script>
    function validateForm() {
      const nisn = document.forms["siswaForm"]["nisn"].value;
      const nama = document.forms["siswaForm"]["nama"].value;
      const kelas = document.forms["siswaForm"]["kelas"].value;
      const jurusan = document.forms["siswaForm"]["jurusan"].value;
      const jenis_kelamin = document.forms["siswaForm"]["jenis_kelamin"].value;
      const tanggal_lahir = document.forms["siswaForm"]["tanggal_lahir"].value;
      const tempat_lahir = document.forms["siswaForm"]["tempat_lahir"].value;
      const agama = document.forms["siswaForm"]["agama"].value;
      const alamat = document.forms["siswaForm"]["alamat"].value;

      if (nisn == "" || nama == "" || kelas == "" || jurusan == "" || jenis_kelamin == "" || tanggal_lahir == "" || tempat_lahir == "" || agama == "" || alamat == "") {
        alert("Semua kolom harus diisi!");
        return false;
      }

      if (isNaN(nisn)) {
        alert("NIS harus berupa angka!");
        return false;
      }

      return true;
    }
  </script>
</head>

<body class="fade-in">
  <h3>TAMBAH DATA SISWA</h3>
  <form name="siswaForm" action="system/insert.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <label for="nisn">Nis</label>
    <input type="text" name="nisn">
    <br><br>

    <label for="nama">Nama</label>
    <input type="text" name="nama">
    <br><br>

    <label for="kelas">Kelas</label>
    <input type="text" name="kelas">
    <br><br>

    <label for="jurusan">Jurusan</label>
    <select name="jurusan" id="jurusan" required>
      <option value="">-- Pilih Jurusan --</option>
      <option value="PPLG">PPLG</option>
      <option value="AKL">AKL</option>
      <option value="MPLB">MPLB</option>
      <option value="PM">PM</option>
    </select>
    <br><br>

    <label for="jenis_kelamin">Jenis Kelamin</label>
    <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
    <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
    <br><br>

    <label for="tanggal_lahir">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir">
    <br><br>

    <label for="tempat_lahir">Tempat Lahir</label>
    <input type="text" name="tempat_lahir">
    <br><br>

    <label for="agama">Agama</label>
    <select name="agama" id="agama" required>
      <option value="">-- Pilih Agama --</option>
      <option value="Islam">Islam</option>
      <option value="Kristen">Kristen</option>
      <option value="Katolik">Katolik</option>
      <option value="Hindu">Hindu</option>
      <option value="Budha">Budha</option>
      <option value="Konghucu">Konghucu</option>
    </select>
    <br><br>

    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
    <br><br>

    <label for="foto">Foto Profil</label>
    <input type="file" name="foto" accept="image/*">
    <br><br>

    <button type="submit">Tambah</button>
    <a href="list_data.php">Kembali</a>
  </form>
</body>

</html>