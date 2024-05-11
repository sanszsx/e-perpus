<?php
// Pastikan pengguna telah login
session_start();
if (isset($_SESSION["token"])) {
  header("Location: admin/dashboard.php"); // Redirect ke halaman dashboard jika sudah login
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/js/bootstrap.min.js">
</head>

<style>
  .containercuy{
    height: 100vh;
  }
</style>

<body>
  <div class="containercuy d-flex justify-content-center align-items-center" style="background-color: #e4eaef;">
    <div class="wrapper p-3" style="width: 38%; height: 50vh; background-color: white">
      <h3>E-Perpus</h3>
      <?php
      if (isset($_GET["notif"])) {
        if ($_GET["notif"] == "passwordsalah") {
          echo "<p style='color: red; margin-bottom: 5px'>Password salah</p>";
        } elseif ($_GET["notif"] == "gagal") {
          echo "<p style='color: red; margin-bottom: 5px'>User tidak terdaftar</p>";
        }
      }
      
      ?>
      <form action="aksilogin.php" method="post">
        <label for="username">Username</label>
        <input type="text" class="form-control form-control-sm mb-2" name="username" id="" aria-describedby="helpId"
          placeholder="masukkan username">  
        <label for="password">Password</label>
        <input type="password" class="form-control form-control-sm mb-2" name="password" id="" aria-describedby="helpId"
          placeholder="masukkan password">
        <button type="submit" class="btn btn-primary btn-outline w-100 mt-3">Login</button>
      </form>
    </div>
  </div>
</body>

</html>