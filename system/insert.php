<?php
include '../includes/koneksi.php';

$nisn = $_POST['nisn'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$tempat_lahir = $_POST['tempat_lahir'];
$agama = $_POST['agama'];
$alamat = $_POST['alamat'];

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["foto"]["tmp_name"]);
if ($check === false) {
    header("Location: ../add_form.php?error=" . urlencode("File is not an image."));
    exit;
}

// Check file size (limit to 2MB)
if ($_FILES["foto"]["size"] > 2000000) {
    header("Location: ../add_form.php?error=" . urlencode("Sorry, your file is too large."));
    exit;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    header("Location: ../add_form.php?error=" . urlencode("Sorry, only JPG, JPEG, & PNG files are allowed."));
    exit;
}

// Try to upload file
if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    $foto = basename($_FILES["foto"]["name"]);
} else {
    header("Location: ../add_form.php?error=" . urlencode("Sorry, there was an error uploading your file."));
    exit;
}

$query = "INSERT INTO siswa (nisn, nama, kelas, jurusan, jenis_kelamin, tanggal_lahir, tempat_lahir, agama, alamat, foto) VALUES ('$nisn', '$nama', '$kelas', '$jurusan', '$jenis_kelamin', '$tanggal_lahir', '$tempat_lahir', '$agama', '$alamat', '$foto')";

if ($connection->query($query) === TRUE) {
    header("Location: ../list_data.php?success=Data berhasil ditambahkan.");
} else {
    header("Location: ../add_form.php?error=" . urlencode("Error: " . $query . "<br>" . $connection->error));
}

$connection->close();
?>