
<?php


include("../koneksi.php");


$nama = $_POST["nama_buku"];
$detail = $_POST["keterangan_buku"];


$q = "INSERT INTO `buku` VALUES (NULL, '$nama', '$detail')";

$result = mysqli_query($conn, $q);

if ($result == TRUE) {
  header("location: buku.php?notif=berhasil");
}

die();

?>