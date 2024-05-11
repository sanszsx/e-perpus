<?php
session_start();
session_destroy();
header("Location: ../index.php"); // Redirect kembali ke halaman login setelah logout
?>