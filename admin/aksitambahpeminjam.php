
<?php


include("../koneksi.php");


$nama = $_POST["nama_peminjam"];
$kelas = $_POST["kelas"];
$buku = $_POST["buku"];


$q = "INSERT INTO `peminjam` VALUES (NULL, '$nama', '$kelas', '$buku')";

$result = mysqli_query($conn, $q);

if ($result == TRUE) {
  header("location: peminjam.php?notif=berhasil");
} else {
}

die();

?>