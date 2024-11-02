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

// Proses pengeditan produk
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Proses update database
    $query = "UPDATE produk SET nama_produk = '$nama_produk', deskripsi = '$deskripsi', harga = '$harga' WHERE id = '$product_id'";
    if (mysqli_query($conn, $query)) {
        echo "Produk berhasil diperbarui.";
        header("Location: product-detail.php?id=" . $product_id);
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - <?php echo $product['nama_produk']; ?></title>
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            color: #F46A06;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            color: #555;
        }

        .submit-button {
            display: block;
            text-align: center;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            border-radius: 8px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #218838;
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
        <form method="post">
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" value="<?php echo $product['nama_produk']; ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5" required><?php echo $product['deskripsi']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?php echo $product['harga']; ?>" required>
            </div>

            <button type="submit" class="submit-button">Simpan Perubahan</button>
        </form>
        <br>
        <a style="color: red; text-decoration: none;" href="product-detail.php?id=<?php echo $product_id; ?>" class="map-button">Batalkan Edit</a>
    </div>

    <div class="footer">
        &copy; 2024 Jogja Love Palestine, All Rights Reserved.
    </div>

</body>
</html>
