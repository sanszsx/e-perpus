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
  <title>Buku | Dashboard</title>
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
            <h5>Buku</h5>
            <p>List Buku</p>
          </div>
          <table style="width: 100%;" class="table">
            <tr>
              <th class="p-3">Nama Buku</th>
              <th class="p-3">Keterangan Buku</th>
              <th class="p-3">Aksi</th>
            </tr>
            <?php
            include('../koneksi.php');
            $q = "SELECT * FROM `buku` ";
            $result = mysqli_query($conn, $q);
            while ($d = mysqli_fetch_array($result)) {
              ?>
              <tr>
                <td class="p-3">
                  <?php echo $d['nama_buku']; ?>
                </td>
                <td class="p-3">
                  <?php echo $d['detail_buku']; ?>
                </td>
                <td class="p-3"><a href="buku.php?edit=true&id=<?php echo $d['id_buku']; ?>">Edit</a> | <a
                    href="aksihapusbuku.php?id=<?php echo $d['id_buku']; ?>">Delete</a></td>
              </tr>
              <?php
            }
            ?>
          </table>
        </div>
      </div>


      <?php
      if (!isset($_GET["edit"])) {
          ?>
          <div class="row p-3">
            <div class="col-md-12 bg-white shadow-sm p-3">
              <h3>Tambah Data Buku</h3>
              <?php
              if (isset($_GET["notif"])) {
                if ($_GET["notif"] == "berhasil") {
                  echo "<p style='color: green; margin-bottom: 5px'>Data berhasil di tambah</p>";
                } else {
                  echo "<p style='color: red; margin-bottom: 5px'>Terjadi kesalahan</p>";
                }
              }
              ?>
              <form action="aksitambahbuku.php" method="post">
                <label for="nama_buku">Nama Buku</label>
                <input type="text" class="form-control form-control-sm mb-2 w-50" name="nama_buku" id=""
                  aria-describedby="helpId" placeholder="masukkan nama buku" required>
                <label for="" class="form-label">Keterangan Buku</label>
                <div class="form-floating mb-3">
                  <textarea required class="form-control w-50" name="keterangan_buku" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                  <label for="floatingTextarea2">keterangan</label>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-sm">Tambah Buku</button>
              </form>
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
            <div class="col-md-12 bg-white shadow-sm p-3">
              <h3>Edit Data Buku</h3>
              <form action="aksieditbuku.php" method="post">
                <?php
                include("../koneksi.php");
                $id_buku = $_GET['id'];
                $q = "SELECT * FROM `buku` where id_buku='$id_buku'";
                $result = mysqli_query($conn, $q);
                while ($d = mysqli_fetch_array($result)) {
                  ?>

                  <label for="nama_buku">Nama Buku</label>
                  <input type="text" class="form-control form-control-sm mb-2 w-50" name="nama_buku" id=""
                    aria-describedby="helpId" placeholder="masukkan nama buku" value="<?= $d[1] ?>" required>
                  <label for="" class="form-label">Keterangan Buku</label>
                  <input type="text" class="form-control form-control-sm mb-2 w-50" name="keterangan_buku" id=""
                    aria-describedby="helpId" placeholder="masukkan nama buku" value="<?= $d[2] ?>" required>
                  <button type="submit" class="btn btn-outline-primary btn-sm mt-5">Edit Buku</button>
                  <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>

                  <?php
                }
                ?>
              </form>
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