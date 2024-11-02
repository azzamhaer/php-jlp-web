<?php
// Memulai sesi
session_start();
include 'db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Ambil merchant_id berdasarkan username
$username = $_SESSION['username'];
$query = "SELECT id FROM merchants WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $merchant = mysqli_fetch_assoc($result);
    $merchant_id = $merchant['id'];
} else {
    echo "Merchant tidak ditemukan.";
    exit();
}

// Proses ketika form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Proses upload gambar
    $gambar_produk = $_FILES['gambar_produk']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar_produk);
    move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file);

    // Query untuk menambah produk baru
    $query = "INSERT INTO produk (merchant_id, nama_produk, deskripsi, gambar_produk, harga) 
              VALUES ('$merchant_id', '$nama_produk', '$deskripsi', '$gambar_produk', '$harga')";

    if (mysqli_query($conn, $query)) {
        header("Location: katalog.php");
        exit();
    } else {
        echo "Gagal menambah produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
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
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            padding: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        button {
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
        }

        .preview-img {
            margin-bottom: 20px;
        }

        .back {
            padding-right: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }
        }

        input[type="file"] {
            display: none;
        }

        .file1 {
            border: none;
            margin-top: 20px;
            padding: 16px 10%;
            background-color: #28a745;
            color: #ffffff;
            font-size: 10px;
            text-align: center;
            cursor: pointer;
            text-transform: uppercase;
            vertical-align: middle;
            align-items: center;
            border-radius: 16px;
            transition: 0.5s;
            width: 20%  !important; 
        }

        .file1:hover {
            background-color: #218838;
            cursor: pointer;
            transition: 0.5s;
        }
    </style>
</head>

<body>

    <div class="container">

        <a href="katalog.php" style="text-decoration: none;">
            <button class="back">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 800 800">
                    <path fill="#fff"
                        d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
                    </path>
                </svg>
                <span>Back</span>
            </button>
        </a>

        <h1>Tambah Produk Baru</h1>
        <form action="tambah-produk.php" method="post" enctype="multipart/form-data">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" placeholder="Nama produk Anda" name="nama_produk" required>

            <label for="deskripsi">Deskripsi Produk</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Gunakan kalimat yang sangat singkat agar tidak terpotong saat ditampilkan" required></textarea>

            <label for="harga">Harga Produk (Rp)</label>
            <input type="number" id="harga" name="harga" required>

            <label for="gambar_produk">Gambar Produk</label><br>
            <div class="rectangle" name="main_image">
                <input type="file" class="file1" id="gambar_produk" name="gambar_produk" accept="image/*" required>
                <label for="gambar_produk" class="file1">Upload file</label>
            </div>

            <div class="preview-img">
                <img id="preview" src="#" alt="Preview Gambar" class="product-image" style="display: none; margin-top: 25px;">
            </div>

            <button type="submit">Tambah Produk</button>
        </form>
    </div>

    <script>
        // Preview gambar sebelum di-upload
        const inputGambar = document.getElementById('gambar_produk');
        const preview = document.getElementById('preview');

        inputGambar.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>