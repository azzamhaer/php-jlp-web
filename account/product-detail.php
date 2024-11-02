<?php
// Memulai sesi
session_start();
include 'db.php';

// Cek apakah id produk diberikan
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query untuk mendapatkan data produk berdasarkan id
    $query = "SELECT * FROM produk WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Produk tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak diberikan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?php echo $product['nama_produk']; ?></title>
    <link rel="shortcut icon" href="../assets/images/logo.png">

    <!-- Custom styling -->
    <style>
        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info {
            padding: 15px 0;
        }

        .product-info h1 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }

        .rating {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 10px;
        }

        .rating span {
            background-color: white;
            border-radius: 5px;
            padding: 5px 10px;
            font-weight: bold;
        }

        .description, .address, .contact {
            margin-bottom: 20px;
        }

        .description p, .address p, .contact p {
            margin: 0;
            color: #555;
        }

        .description h2, .address h2, .contact h2 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #F46A06;
        }

        .map-button {
            display: block;
            text-align: center;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            border-radius: 8px;
            margin: 20px 0;
            text-decoration: none;
            font-weight: bold;
        }

        .map-button:hover {
            background-color: #218838;
        }

        .delete-button {
            display: block;
            text-align: center;
            padding: 15px;
            background-color: #FF1A1A;
            color: #fff;
            border-radius: 8px;
            margin: 20px 0;
            text-decoration: none;
            font-weight: bold;
        }

        .delete-button:hover {
            background-color: #ba1313;
        }

        .map {
            width: 100%;
            height: 300px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            color: #aaa;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .product-info h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="uploads/<?php echo $product['gambar_produk']; ?>" alt="<?php echo $product['nama_produk']; ?>" class="product-image">

        <div class="product-info">
            <h1><?php echo $product['nama_produk']; ?></h1>

            <div class="rating">
                <span>⭐ 4.5</span> <!-- Ini rating contoh, Anda bisa ambil dari database jika ada -->
            </div>

            <div class="description">
                <h2>Deskripsi</h2>
                <p><?php echo $product['deskripsi']; ?></p>
            </div>

            <div class="address">
                <h2>Harga</h2>
                <p>Rp. <?php echo $product['harga']; ?></p> <!-- Ini contoh alamat -->
            </div>
            <a href="edit-product.php?id=<?php echo $product_id ?>" class="map-button">Edit Produk</a>
            <a href="delete-product.php?id=<?php echo $product['id']; ?>" class="delete-button" onclick="return confirmDelete()">Hapus Produk</a>
            <a href="katalog.php" style="color: blue; text-decoration: none;">←	Kembali ke katalog</a>

<script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus produk ini?");
    }
</script>

        </div>
    </div>

    <div class="footer">
        &copy; 2024 Jogja Love Palestine, All Rights Reserved.
    </div>

</body>
</html>
