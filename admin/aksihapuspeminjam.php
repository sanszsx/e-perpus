
<?php
include("../koneksi.php");

$id = $_GET['id'];

$q = "DELETE FROM `peminjam` WHERE id_peminjam=$id";
$result = mysqli_query($conn, $q);

if ($result) {
  header("location: peminjam.php");
}
?>