

<?php
include("../koneksi.php");

$id = $_POST["id"];
$nama = $_POST["nama_peminjam"];
$kelas = $_POST["kelas"];
$buku = $_POST["buku"];


$q = "UPDATE peminjam SET nama_peminjam='$nama', kelas='$kelas', buku='$buku' WHERE id_peminjam='$id'";
$result = mysqli_query($conn, $q);

header("Location: peminjam.php");


?>