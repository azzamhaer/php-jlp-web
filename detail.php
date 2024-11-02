<?php
// Start session and include the database connection
session_start();
include 'account/db.php'; // Pastikan file ini berisi koneksi database

// Cek apakah ID merchant tersedia di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk mendapatkan data merchant berdasarkan id
    $query = "SELECT * FROM merchants WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Jika merchant ditemukan
    if (mysqli_num_rows($result) > 0) {
        $merchant = mysqli_fetch_assoc($result);
    } else {
        echo "Merchant tidak ditemukan.";
        exit();
    }

    // Query untuk mendapatkan daftar produk dari merchant tersebut
    $product_query = "SELECT * FROM produk WHERE merchant_id = '$id'";
    $product_result = mysqli_query($conn, $product_query);
} else {
    echo "ID merchant tidak ditemukan.";
    exit();
}

$previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $merchant['merchant_name']; ?> - JLP</title>
    <link rel="shortcut icon" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- BOXICONS -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <!-- <box-icon name='like' size='sm'></box-icon> -->
</head>

<body>
    <div class="container">

        <!-- Tombol Back -->
        <div class="back-button">
            <a href="<?php echo $previous_url; ?>" style="color: black;"><i class="fas fa-arrow-left"></i></a>
        </div>

        <!-- Gambar Utama dan Rating -->
        <div class="image-container">
            <img src="<?php echo 'account/' . $merchant['main_image']; ?>" alt="">
            <div class="sub">
                <img src="<?php echo 'account/' . $merchant['main_image']; ?>" alt="">
                <img src="<?php echo 'account/' . $merchant['main_image']; ?>" alt="">
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="description">
            <div class="sub">
                <h1><?php echo $merchant['merchant_name']; ?></h1><br>
                <div class="rating">
                    <span>⭐ 4.8</span>
                </div>
            </div>
            <p><?php echo substr($merchant['description'], 0, 5000); ?></p>
        </div>

        <!-- Informasi Restoran -->
        <div class="info">
            <div class="info-item">
                <h4>Alamat</h4>
                <p><?php echo $merchant['alamat']; ?></p>
            </div>
            <div class="info-item">
                <h4>Jam Operasional</h4>
                <p><?php echo $merchant['operation_hours']; ?></p>
            </div>
            <div class="info-item">
                <h4>Telepon</h4>
                <a href="tel:<?php echo $merchant['phone']; ?>"><?php echo $merchant['phone']; ?></a>
            </div>
            <div class="info-item">
                <h4>Sosial Media</h4>
                <p>@<?php echo !empty($merchant['social_media']) ? $merchant['social_media'] : '-'; ?></p>
            </div>
            <div class="info-item">
                <h4>Website</h4>
                <p><?php echo !empty($merchant['website']) ? $merchant['website'] : '-'; ?></p>
            </div>
        </div>

        <!-- Tombol dan Peta -->
        <?php if (!empty($merchant['maps_pin'])): ?>
            <div class="map-section">
                <h2>Lokasi</h2>
                <!-- <button class="direction-btn">ARAHKAN SAYA KE <?php echo strtoupper($merchant['merchant_name']); ?></button> -->
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=<?php echo $merchant['maps_pin']; ?>" width="100%" height="300" style="border-radius:8px; border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        <?php endif; ?>

        <!-- KATALOG -->
        <div id="katalog" class="product-catalog"><br>
            <h1>Katalog</h1><br><br>
            <div class="product-list">
                <?php if (mysqli_num_rows($product_result) > 0): ?>
                    <?php while ($product = mysqli_fetch_assoc($product_result)): ?>
                        <div class="product-card">
                            <div class="image-wrapper">
                                <img src="<?php echo 'account/uploads/' . $product['gambar_produk']; ?>" alt="<?php echo $product['nama_produk']; ?>" class="product-img">
                            </div>
                            <h3><b><?php echo $product['nama_produk']; ?></b></h3>
                            <span class="open-modal-btn"><?php echo $product['deskripsi']; ?></span>

                            <p class="price"><?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
                            <a href="https://wa.me/<?php echo $merchant['phone']; ?>?text=Assalamualaikum,%20saya%20tertarik%20dengan%20<?php echo $product['nama_produk']; ?>.%20Bisakah%20Anda%20memberitahu%20lebih%20lanjut?" class="buy-now-btn" target="_blank">Beli</a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="p-product-list">Belum ada sesuatu disini.</p><br><br>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="imageModal" class="image-modal">
        <span id="closeModal" class="close-btn">&times;</span>
        <img class="image-modal-content" id="modalImg">
    </div>

    <script src="assets/js/detail.js"></script>
</body>

</html>