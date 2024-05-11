

<?php
include("../koneksi.php");

$id = $_POST["id"];
$nama = $_POST["nama_buku"];
$detail = $_POST["keterangan_buku"];


$q = "UPDATE buku SET nama_buku='$nama', detail_buku='$detail' WHERE id_buku='$id'";
$result = mysqli_query($conn, $q);

header("Location: buku.php");


?>