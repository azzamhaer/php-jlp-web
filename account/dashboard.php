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

// Ambil data user dari database berdasarkan sesi username
$username = $_SESSION['username'];
$query = "SELECT id, username, merchant_name, email, phone, profile_picture, main_image, description, alamat, operation_hours, social_media, website 
          FROM merchants WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
  $merchant_id = $user['id'];

  // Cek apakah data penting sudah diisi (merchant_name, email, phone, alamat)
  if (empty($user['merchant_name']) || empty($user['email']) || empty($user['phone']) || empty($user['alamat'])) {
    // Jika salah satu field kosong, redirect ke halaman onboarding
    header("Location: onboarding.php");
    exit();
  }

  // Query untuk menghitung jumlah produk
  $product_query = "SELECT COUNT(*) AS total_produk FROM produk WHERE merchant_id = '$merchant_id'";
  $product_result = mysqli_query($conn, $product_query);
  $product_data = mysqli_fetch_assoc($product_result);
  $jumlah_produk = $product_data['total_produk'];
} else {
  echo "Data user tidak ditemukan!";
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Merchant Dashboard</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="../assets/images/logo.png">

  <!-- 
    - custom css link
  -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/das.css">
  <link rel="stylesheet" href="./assets/css/lapor.css">
  <link rel="stylesheet" href="./assets/css/katal.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;900&display=swap"
    rel="stylesheet">

  <!-- 
    - material icon link
  -->
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />


  <style>
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

  <!-- 
    - #HEADER
  -->

  <div class="header">
    <h1>JLP Merchant</h1>
    <div class="cardk">
      <div class="kolom1">
        <a class="toko" href="../detail.php?id=<?php echo $user['id']; ?>">Lihat Toko Saya</a>
      </div>
      <div class="kolom2">
        <img alt="Profile picture" height="50" src="<?php echo $user['profile_picture']; ?>" width="50" />
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
        <img alt="Profile picture" height="50" src="<?php echo $user['profile_picture']; ?>" width="50" />
        <p class="profile-title"><?php echo $user['merchant_name']; ?></p>
      </div>
      <div class="back-button" onclick="toggleSidebar()">
        <i class="fas fa-times" style='font-size:24px'></i>
      </div>
      <a class="active" href="dashboard.php" id="fa"><i class="fas fa-home"></i> Beranda</a>
      <a href="katalog.php" id="fa"><i class="fas fa-box"></i> Katalog</a>
      <a href="laporan.php" id="fa"><i class="fas fa-chart-bar"></i> Laporan</a>
      <a href="pengaturan.php" id="fa"><i class="fas fa-cog"></i> Pengaturan</a>
      <a href="../detail.php?id=<?php echo $user['id']; ?>" id="fa" class="lts"><i class="fas fa-store"></i> Lihat Toko Saya</a>
      <a href="logout.php" id="fa" class="lgo"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="content">
      <div class="title-card">
        <h1>Dashboard</h1>
      </div>
      <div class="table-container">
        <div class="card profile-card">

          <div class="profile-card-wrapper">

            <figure class="card-avatar">
              <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Image" width="48" height="48">
            </figure>

            <div>
              <p class="card-title"><?php echo $user['merchant_name']; ?></p>

              <p class="card-subtitle"><?php echo $user['description']; ?></p>
            </div>

          </div>

          <div class="divider card-divider"></div>

          <ul class="contact-list">

            <li>
              <a href="mailto:<?php echo $user['email']; ?>" class="contact-link icon-box">
                <span class="material-symbols-rounded  icon">mail</span>

                <p class="text"><?php echo $user['email']; ?></p>
              </a>
            </li>

            <li>
              <a href="tel:<?php echo $user['phone']; ?>" class="contact-link icon-box">
                <span class="material-symbols-rounded  icon">call</span>

                <p class="text"><?php echo $user['phone']; ?></p>
              </a>
            </li>

            <li>
              <a href="<?php echo $user['social_media']; ?>" class="contact-link icon-box">
                <span class="material-symbols-rounded  icon">person</span>

                <p class="text">@<?php echo $user['social_media']; ?></p>
              </a>
            </li>

            <li>
              <a href="https://<?php echo $user['website']; ?>" class="contact-link icon-box" target="_blank">
                <span class="material-symbols-rounded  icon">globe</span>

                <p class="text"><?php echo $user['website']; ?></p>
              </a>
            </li>

          </ul>

        </div>
      </div>
      <div class="table-container">
        <div class="card stats">
          <div class="stat">
            <i class="fas fa-shopping-bag fa-5x" style="margin-right: 20px; margin-top: 10px;">
            </i>
            <div>
              <div class="value">
                <data class="card-data" value="<?php echo $jumlah_produk; ?>"><?php echo $jumlah_produk; ?></data>

              </div>
              <div class="label">
                Jumlah Produk
              </div>
            </div>
          </div>
          <div class="stat">
            <i class="fas fa-shopping-cart" style="margin-right: 20px; margin-top: 10px;">
            </i>
            <div>
              <div class="value">
                0
              </div>
              <div class="label">
                Jumlah Pembelian
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="table-container">
        <div class="content">
          <div class="amount" style="font-size: 25px; font-weight: 600;">
            Saldo
          </div>
          <div class="card0 revenue">
            <div class="amount" style="margin-bottom: 10px;">
              Rp. 0
            </div>
            <div class="change">
              <div class="percentage up">
                <i class="fas fa-arrow-up">
                </i>
                15% Prev Week
              </div>
              <div class="percentage down">
                <i class="fas fa-arrow-down">
                </i>
                10% Prev Month
              </div>
            </div>
          </div>
        </div>
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

</body>

</html>