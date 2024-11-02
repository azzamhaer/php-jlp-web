<?php
// Memulai sesi
session_start();
include 'db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke index.php
    header("Location: index.php");
    exit();
}

// Mengambil data dari form onboarding
$merchant_name = mysqli_real_escape_string($conn, $_POST['merchant_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$tujuan = mysqli_real_escape_string($conn, $_POST['tujuan']);
$referral = mysqli_real_escape_string($conn, $_POST['referral']);

// Update data ke dalam tabel merchants berdasarkan username yang login
$username = $_SESSION['username'];
$query = "UPDATE merchants 
          SET merchant_name='$merchant_name', email='$email', phone='$phone', alamat='$alamat' , tujuan='$tujuan' , referral='$referral' 
          WHERE username='$username'";

if (mysqli_query($conn, $query)) {
    // Redirect ke dashboard setelah sukses
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
