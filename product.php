<?php
// Start session and include the database connection
session_start();
include 'account/db.php'; // Pastikan file ini berisi koneksi database

// Cek apakah ID produk tersedia di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Query untuk mendapatkan data produk berdasarkan id
    $query = "SELECT p.*, m.id, m.merchant_name, m.phone, m.profile_picture FROM produk p JOIN merchants m ON p.merchant_id = m.id WHERE p.id = '$id'";
    $result = mysqli_query($conn, $query);

    // Jika produk ditemukan
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Produk tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak ditemukan.";
    exit();
}

$previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo htmlspecialchars($product['nama_produk']); ?> - JLP</title>
    <link rel="stylesheet" href="assets/css/product-detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Gambar Utama dan Deskripsi Produk -->
        <div class="product-container">
        <div class="back-button">
                <a href="<?php echo $previous_url; ?>" style="color: black;"><i class="fas fa-arrow-left"></i></a>
            </div><br>
            <div class="product-image">
                <img src="<?php echo 'account/uploads/' . htmlspecialchars($product['gambar_produk']); ?>" alt="<?php echo htmlspecialchars($product['nama_produk']); ?>" onclick="openModal(this)">
            </div>
            <div class="product-details">
                <h1><?php echo htmlspecialchars($product['nama_produk']); ?></h1>
                <p><?php echo htmlspecialchars($product['deskripsi']); ?></p>
                <a style="text-decoration: none !important;" href="detail.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                <div class="plex">
                    
                    <img src="account/<?php echo htmlspecialchars($product['profile_picture']); ?>" alt="Logo Toko" class="logo-toko">
                    <b><p class="marginkiri5px"><?php echo htmlspecialchars($product['merchant_name']); ?></p></b>
                    
                </div></a>
            </div>
        </div>

        <!-- Informasi Merchant -->
        <div class="merchant-info">
            <p class="price">Rp<?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
            <a href="https://wa.me/<?php echo htmlspecialchars($product['phone']); ?>?text=Assalamualaikum,%20saya%20tertarik%20dengan%20<?php echo htmlspecialchars($product['nama_produk']); ?>.%20Bisakah%20Anda%20memberitahu%20lebih%20lanjut?" class="buy-now-btn" target="_blank">Beli</a>
        </div>

        <!-- Tombol Back -->

    </div>

    <div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="fullImage">
</div>
</body>
<script>
    function openModal(imageElement) {
    var modal = document.getElementById('imageModal');
    var modalImg = document.getElementById('fullImage');
    modal.style.display = "block";
    modalImg.src = imageElement.src; // Set modal image source to clicked image
}

function closeModal() {
    var modal = document.getElementById('imageModal');
    modal.style.display = "none"; // Hide the modal
}

 </script>
</html>
