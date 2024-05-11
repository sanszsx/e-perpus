
<?php
include("koneksi.php");

// MENGAMBIL INPUTAN DARI LOGIN.PHP
$username = $_POST["username"];
$password = $_POST["password"];

// QUERY UNTUK MENGECEK EMAIL VALID ATAU TIDAK
$q = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $q);

// JIKA EMAIL VALID MAKA AKAN MELAKUKAN LOGIN
if (mysqli_num_rows($result) == 1) {

  $data = mysqli_fetch_array($result);
  $hash_pw = $data["password"];

  // MENGECEK HASH PASSWORD SESUAI APA TIDAK
  if (password_verify($password, $hash_pw)) {

    // JIKA SESUAI MAKA AKAN MEMBUAT SESI UNTUK USER DENGAN ISI EMAIL
    session_start();
    $_SESSION["token"] = $password;
    // BERHASIL LOGIN AKAN KE REDIRECT KE DAHSBOARD
    header("Location: admin/dashboard.php");
  } else {

    // JIKA PASSWORD SALAH MAKA AKAN GET URL DAN MENAMPILKAN PESAN ERROR DI HALAMAN LOGIN
    header("Location: index.php?notif=passwordsalah");
  }

} else {

  // JIKA GAGAL AKAN GET URL DAN MENAMPILKAN DI HALAMAN LOGIN
  header("Location: index.php?notif=gagal");
} 


?>