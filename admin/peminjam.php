<?php
// Pastikan pengguna telah login
session_start();
if (!isset($_SESSION["token"])) {
  header("Location: ../index.php"); // Redirect ke halaman login jika belum login
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Peminjam | Dashboard</title>
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
          <a href="./dashboard.php">Dashboard</a>
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
        <div class="col-md-12 bg-white shadow-sm">
          <div class="p-3">
            <h5>Data Peminjam</h5>
            <p>Detail para meminjam</p>
          </div>
          <table style="width: 100%;" class="table">
            <tr>
              <th class="p-3">Nama Peminjam</th>
              <th class="p-3">Kelas</th>
              <th class="p-3">Buku</th>
              <th class="p-2">Aksi</th>
            </tr>
            <tr>
              <?php
              include('../koneksi.php');
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
                <td class="p-3"><a href="peminjam.php?edit=true&id=<?php echo $d['id_peminjam']; ?>">Edit</a> | <a
                    href="aksihapuspeminjam.php?id=<?php echo $d['id_peminjam']; ?>">Delete</a></td>
              </tr>
              <?php
              }
              ?>
            </tr>
          </table>
        </div>
      </div>

      <?php
      if (!isset($_GET["edit"])) {
        ?>
        <div class="row p-3">
          <div class="col-md-12 bg-white shadow-sm">
            <div class="p-3">
              <h5>Tambah Data Peminjam</h5>
              <?php
              if (isset($_GET["notif"])) {
                if ($_GET["notif"] == "berhasil") {
                  echo "<p style='color: green; margin-bottom: 5px'>Data berhasil di tambah</p>";
                } else {
                  echo "<p style='color: red; margin-bottom: 5px'>Terjadi kesalahan</p>";
                }
              }
              ?>
              <form action="aksitambahpeminjam.php" method="post">
                <div class="row">
                  <div class="mb-3 col-6">
                    <label for="" class="form-label">Nama Peminjam</label>
                    <input type="text" class="form-control form-control-sm" name="nama_peminjam" id=""
                      aria-describedby="helpId" placeholder="">
                    <label for="" class="form-label">Kelas</label>
                    <input type="text" class="form-control form-control-sm" name="kelas" id="" aria-describedby="helpId"
                      placeholder="">
                    <label for="" class="form-label">Buku</label>
                    <input type="text" class="form-control form-control-sm" name="buku" id="" aria-describedby="helpId"
                      placeholder="">
                    <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Tambah Peminjam</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php
      }
      ?>


      <?php
      if (isset($_GET["edit"])) {
        if ($_GET["edit"] == "true") {
          ?>

          <div class="row p-3">
            <div class="col-md-12 bg-white shadow-sm">
              <div class="p-3">
                <h5>Edit Data Peminjam</h5>

                <?php
                if (isset($_GET["notif"])) {
                  if ($_GET["notif"] == "berhasil") {
                    echo "<p style='color: green; margin-bottom: 5px'>Data berhasil di tambah</p>";
                  } else {
                    echo "<p style='color: red; margin-bottom: 5px'>Terjadi kesalahan</p>";
                  }
                }
                ?>

                <div class="row">
                  <div class="mb-3 col-6">
                    <form action="aksieditpeminjam.php" method="post">

                      <?php
                      include("../koneksi.php");
                      $id_peminjam = $_GET['id'];
                      $q = "SELECT * FROM `peminjam` where id_peminjam='$id_peminjam'";
                      $result = mysqli_query($conn, $q);
                      while ($d = mysqli_fetch_array($result)) {
                        ?>

                        <label for="" class="form-label">Nama Peminjam</label>
                        <input type="text" class="form-control form-control-sm" value="<?= $d[1] ?>"  name="nama_peminjam"
                          id="" aria-describedby="helpId" placeholder="">
                        <label for="" class="form-label">Kelas</label>
                        <input type="text" class="form-control form-control-sm" value="<?= $d[2] ?>" name="kelas" id=""
                          aria-describedby="helpId" placeholder="">
                        <label for="" class="form-label">Buku</label>
                        <input type="text" class="form-control form-control-sm" value="<?= $d[3] ?>" name="buku" id=""
                          aria-describedby="helpId" placeholder="">
                        <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Edit Peminjam</button>
                        <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>

                        <?php
                      }
                      ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php
        } else {
          echo "<p style='color: red; margin-bottom: 5px'>Terjadi kesalahan</p>";
        }
      }
      ?>

    </div>
  </div>
</body>

</html>