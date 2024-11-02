<?php
// Memulai sesi
session_start();
include 'db.php';

// Cek apakah id produk diberikan
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query untuk menghapus data produk berdasarkan id
    $query = "DELETE FROM produk WHERE id = '$product_id'";

    if (mysqli_query($conn, $query)) {
        echo "Produk berhasil dihapus.";
        header("Location: katalog.php"); // Redirect ke halaman katalog setelah berhasil menghapus
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus produk.";
    }
} else {
    echo "ID produk tidak diberikan.";
    exit();
}
?>
