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

// Ambil data merchant berdasarkan username
$username = $_SESSION['username'];
$query = "SELECT id, merchant_name, profile_picture FROM merchants WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $merchant = mysqli_fetch_assoc($result);
  $merchant_id = $merchant['id'];

  // Cek apakah merchant_name tersedia
  $merchant_name = !empty($merchant['merchant_name']) ? $merchant['merchant_name'] : "Merchant";

  // Ambil semua produk dari merchant ini
  $query = "SELECT * FROM produk WHERE merchant_id = '$merchant_id'";
  $result = mysqli_query($conn, $query);
} else {
  echo "Merchant tidak ditemukan.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Produk</title>
  <link rel="shortcut icon" href="../assets/images/logo.png">

  <!-- custom css link -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/lapor.css">
  <link rel="stylesheet" href="./assets/css/katal.css">

  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;900&display=swap"
    rel="stylesheet">

  <!-- material icon link -->
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />

  <!-- Custom styling for the cards -->
  <style>
    .card-wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      justify-content: flex-start;
    }

    .card {
      width: 200px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
      background-color: #fff;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-radius: 8px;
    }

    .card h2 {
      font-size: 18px;
      margin: 10px 0;
    }

    .card p {
      font-size: 14px;
      color: #555;
    }

    .btn-primary {
      display: inline-block;
      padding: 8px 16px;
      background-color: #139C59;
      color: #fff;
      border-radius: 15px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .toko {
      border: none;
      padding: 10px 22px;
      background-color: #04AA6D;
      color: #ffffff;
      font-size: 10px;
      text-align: center;
      cursor: pointer;
      text-transform: uppercase;
      vertical-align: middle;
      align-items: center;
      border-radius: 15px;
      transition: 0.5s;
      border: 2px solid #139C59;
    }

    .toko:hover {
      border: 2px solid #139C59;
      background-color: #ffffff;
      color: #139C59;
      cursor: pointer;
      transition: 0.5s;
    }

    .cardk {
      display: flex;
      width: 250px;
      padding-right: 20px;
    }

    .kolom1 {
      margin-left: 20px;
      margin: 0 auto;
      margin-top: 5px;
      margin-right: 20px;
    }

    .kolom2 {
      margin-left: 20px;
      margin: 0 auto;
      margin-top: ;
    }

    .btn-primary:hover {
      background-color: #0f7342;
    }

    .lts {
      visibility: hidden;
    }

    .lgo {
      position: relative;
      top: -50px;
    }


    @media (max-width: 768px) {
      .card {
        width: 45%;
      }

      .kolom1 {
        visibility: hidden;
      }

      .kolom2 {
        margin-top: 5px;
      }

      .lts {
        visibility: visible;
      }

      .lgo {
        top: 1px;
      }

      .sidebar {
        width: 300px;
        height: 100%;
        border-radius: 15px;
      }
    }



    @media (max-width: 480px) {
      .card {
        width: 100%;
      }

      .kolom1 {
        visibility: hidden;
      }

      .kolom2 {
        margin-top: 5px;
      }

      .lts {
        visibility: visible;
      }

      .lgo {
        top: 1px;
      }

      .sidebar {
        width: 300px;
        height: 100%;
        border-radius: 15px;
      }
    }
  </style>
</head>


<body>
  <div class="header">
    <h1>JLP Merchant</h1>
    <div class="cardk">
      <div class="kolom1">
        <a class="toko" href="../detail.php?id=<?php echo $merchant['id']; ?>">Lihat Toko Saya</a>
      </div>
      <div class="kolom2">
        <img alt="Profile picture" height="50" src="<?php echo $merchant['profile_picture']; ?>" width="50" />
      </div>
    </div>
    <div class="menu-toggle" onclick="toggleSidebar()">
      <i class="fas fa-bars"></i>
    </div>
  </div>
  <div class="container">
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <div class="sidebar">
      <div class="profile">
        <img alt="Profile picture" height="50" src="<?php echo $merchant['profile_picture']; ?>" width="50" />
        <p class="profile-title"><?php echo $merchant_name; ?></p>
      </div>
      <div class="back-button" onclick="toggleSidebar()">
        <i class="fas fa-times" style='font-size:24px'></i>
      </div>
      <a href="dashboard.php" id="fa"><i class="fas fa-home"></i> Beranda</a>
      <a class="active" href="katalog.php" id="fa"><i class="fas fa-box"></i> Katalog</a>
      <a href="laporan.php" id="fa"><i class="fas fa-chart-bar"></i> Laporan</a>
      <a href="pengaturan.php" id="fa"><i class="fas fa-cog"></i> Pengaturan</a>
      <a href="../detail.php?id=<?php echo $merchant['id']; ?>" id="fa" class="lts"><i class="fas fa-store"></i> Lihat Toko Saya</a>
      <a href="logout.php" id="fa" class="lgo"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="content">
      <div class="title-card">
        <h1>Katalog</h1>
      </div>
      <div class="table-container">
        <main class="container">
          <div class="container1">
            <a href="tambah-produk.php" class="btn-primary">Tambah Produk</a><br><br>
            <div class="card-wrapper">
              <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($product = mysqli_fetch_assoc($result)): ?>
                  <div class="card">
                    <img src="uploads/<?php echo $product['gambar_produk']; ?>"
                      alt="<?php echo $product['nama_produk']; ?>">
                    <h2><?php echo $product['nama_produk']; ?></h2>
                    <p><?php echo $product['deskripsi']; ?></p>
                    <br>
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn-primary">Lihat Detail</a>
                  </div>
                <?php endwhile; ?>
              <?php else: ?>
                <p>Tidak ada produk</p>
              <?php endif; ?>
            </div>
            <br><br>

          </div>
        </main>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="container">

      <ul class="footer-list">

        <li class="footer-item">
          <a href="privacy-policy.php" class="footer-link">Privacy</a>
        </li>

        <li class="footer-item">
          <a href="terms.php" class="footer-link">Terms</a>
        </li>


      </ul>

      <p class="copyright">
        &copy; 2024 <a href="#" class="copyright-link">Jogja Love Palestine</a>, All Rights Reserved.
      </p>

    </div>
  </div>
  <script>
    function toggleSidebar() {
      var sidebar = document.querySelector('.sidebar');
      var overlay = document.querySelector('.sidebar-overlay');
      if (sidebar.style.display === 'block') {
        sidebar.style.display = 'none';
        overlay.style.display = 'none';
      } else {
        sidebar.style.display = 'block';
        overlay.style.display = 'block';
      }
    }
  </script>

  <!-- custom js link -->
  <script src="./assets/js/script.js"></script>
  <script src="./assets/js/katal.js"></script>
</body>

</html>