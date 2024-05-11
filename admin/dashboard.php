<?php
// Pastikan pengguna telah login
session_start();
if (!isset($_SESSION["token"])) {
  header("Location: ../index.php"); // Redirect ke halaman login jika belum login
  exit();
}
include('../koneksi.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Dashboard | Admin</title>
</head>


<style>
  *,
  body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .content {
    /* width: 100%; */
    /* padding: px; */
  }

  .content a {
    display: block;
    margin-block: 20px;
    /* padding: 3px 10px; */
    background-color: #fff;
    /* width: 190px; */
    text-decoration: none;
    /* text-align: center; */
  }
</style>

<body>
  <div class="row">
    <div class="col-2 d-block shadow-lg px-5 py-3" style="min-height: 100vh;">
      <div class=" align-items-center d-flex">
        <div class="content d-block">
          <h4>Perpustakaan</h4>
          <a href="">Dashboard</a>
          <a href="./buku.php">Buku</a>
          <!-- <a href="">Jenis Buku</a> -->
          <a href="./peminjam.php">Peminjam</a>
        </div>
      </div>
    </div>
    <div class="col-10" style="background-color: #e4eaef;">
      <div class="row bg-primary">
        <div class="d-flex justify-content-end align-items-center pe-4" style="height: 60px;">
          <!-- <h1 class="text-dark">cok</h1> -->
          <a href="logout.php" class="text-white text-decoration-none">Logout</a>
        </div>
      </div>
      <div class="row p-3">
        <div class="col-md-4 bg-white shadow-sm p-3" style="margin-right: 10px;">
          <?php
          $q = "SELECT COUNT(*) AS jumlah_baris FROM peminjam;";
          $result = mysqli_query($conn, $q);
          while ($d = mysqli_fetch_assoc($result)) {
            ?>
            <h3><?php echo $d['jumlah_baris']; ?></h3>
            <p>Peminjam</p>
            <?php
          }
          ?>
        </div>
        <div class="col-md-4 bg-white shadow-sm p-3">
        <?php
          $q = "SELECT COUNT(*) AS jumlah_baris FROM buku;";
          $result = mysqli_query($conn, $q);
          while ($d = mysqli_fetch_assoc($result)) {
            ?>
            <h3><?php echo $d['jumlah_baris']; ?></h3>
            <p>Buku</p>
            <?php
          }
          ?>
        </div>
      </div>
      <div class="row p-3">
        <div class="col-md-12 bg-white shadow-sm">
          <div class="p-3">
            <h5>Statistik Peminjam</h5>
            <p>Detail para meminjam</p>
          </div>
          <table style="width: 100%;" class="table">
            <tr>
              <th class="p-3">Nama Peminjam</th>
              <th class="p-3">Kelas</th>
              <th class="p-3">Buku</th>
            </tr>
            <?php
            $q = "SELECT * FROM `peminjam` ";
            $result = mysqli_query($conn, $q);
            while ($d = mysqli_fetch_array($result)) {
              ?>
              <tr>
                <td class="p-3">
                  <?php echo $d['nama_peminjam']; ?>
                </td>
                <td class="p-3">
                  <?php echo $d['kelas']; ?>
                </td>
                <td class="p-3">
                  <?php echo $d['buku']; ?>
                </td>
              </tr>
              <?php
            }
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>