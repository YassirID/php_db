<?php

include "/includes/koneksi.php";


$sql = "SELECT nisn, nama, kelas, jurusan FROM siswa";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table border='1'>";
    echo "<tr><th>NISN</th><th>Nama</th><th>Kelas</th><th>Jurusan</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["nisn"]."</td><td>".$row["nama"]."</td><td>".$row["kelas"]."</td><td>".$row["jurusan"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>