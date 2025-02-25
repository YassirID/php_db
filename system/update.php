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

if (!empty($_FILES["foto"]["tmp_name"])) {
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check === false) {
        header("Location: ../edit.php?id=$nisn&error=" . urlencode("File is not an image."));
        exit;
    }

    if ($_FILES["foto"]["size"] > 2000000) {
        header("Location: ../edit.php?id=$nisn&error=" . urlencode("Sorry, your file is too large."));
        exit;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        header("Location: ../edit.php?id=$nisn&error=" . urlencode("Sorry, only JPG, JPEG, & PNG files are allowed."));
        exit;
    }

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $foto = basename($_FILES["foto"]["name"]);
    } else {
        header("Location: ../edit.php?id=$nisn&error=" . urlencode("Sorry, there was an error uploading your file."));
        exit;
    }
} else {
    $foto = null;
}

$query = "UPDATE siswa SET nama='$nama', kelas='$kelas', jurusan='$jurusan', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', tempat_lahir='$tempat_lahir', agama='$agama', alamat='$alamat'";
if ($foto) {
    $query .= ", foto='$foto'";
}
$query .= " WHERE nisn='$nisn'";

if ($connection->query($query) === TRUE) {
    header("Location: ../profile.php?id=$nisn&success=" . urlencode("Profile has been updated."));
} else {
    header("Location: ../edit.php?id=$nisn&error=" . urlencode("Sorry, there was an error updating your profile."));
}

$connection->close();
?>