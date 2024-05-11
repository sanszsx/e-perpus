
<?php
include("../koneksi.php");

$id = $_GET['id'];

$q = "DELETE FROM `buku` WHERE id_buku=$id";
$result = mysqli_query($conn, $q);

if ($result) {
  header("location: buku.php");
}
?>