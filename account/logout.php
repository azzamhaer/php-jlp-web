<?php
// Memulai sesi
session_start();

// Menghapus semua sesi
session_unset();
session_destroy();

// Redirect ke halaman login
header("Location: index.php");
exit();
?>
