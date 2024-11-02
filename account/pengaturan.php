<?php
// Memulai sesi
session_start();
include 'db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit();
}

// Ambil data user dari database berdasarkan username
$username = $_SESSION['username'];
$query = "SELECT * FROM merchants WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
} else {
  echo "Data user tidak ditemukan!";
  exit();
}

// Proses form saat disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $merchant_name = $_POST['merchant_name'];
  $description = $_POST['description'];
  $alamat = $_POST['alamat'];
  $operation_hours = $_POST['operation_hours'];
  $phone = $_POST['phone'];
  $social_media = $_POST['social_media'];
  $website = $_POST['website'];
  $maps_pin = $_POST['maps_pin'];

  // Upload gambar profil
  if (!empty($_FILES['profile_picture']['name'])) {
    $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
  } else {
    $profile_picture = $user['profile_picture'];
  }

  // Upload gambar utama
  if (!empty($_FILES['main_image']['name'])) {
    $main_image = 'uploads/' . basename($_FILES['main_image']['name']);
    move_uploaded_file($_FILES['main_image']['tmp_name'], $main_image);
  } else {
    $main_image = $user['main_image'];
  }

  // Update data di database
  $update_query = "UPDATE merchants SET 
                        merchant_name = '$merchant_name', 
                        profile_picture = '$profile_picture', 
                        main_image = '$main_image', 
                        description = '$description', 
                        alamat = '$alamat', 
                        operation_hours = '$operation_hours', 
                        phone = '$phone', 
                        social_media = '$social_media', 
                        website = '$website', 
                        maps_pin = '$maps_pin' 
                    WHERE username = '$username'";

  $update_message = '';

  if (mysqli_query($conn, $update_query)) {
    $update_message = "Pengaturan berhasil diperbarui, butuh beberapa saat untuk muncul.<br> Silahkan refresh halaman untuk mengecek.";
  } else {
    $update_message = "Terjadi kesalahan dalam memperbarui pengaturan!";
  }

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
  <link rel="stylesheet" href="./assets/css/lapor.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/seting.css">
  <link rel="stylesheet" href="./assets/css/katal.css">

  <style>
    .masukpakeko {
      background-color: #04AA6D;
      /* Green */
      border: none;
      color: white;
      padding: 16px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      transition-duration: 0.4s;
      cursor: pointer;
      border-radius: 5px;
    }
  </style>

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
      <a href="dashboard.php" id="fa"><i class="fas fa-home"></i> Beranda</a>
      <a href="katalog.php" id="fa"><i class="fas fa-box"></i> Katalog</a>
      <a href="laporan.php" id="fa"><i class="fas fa-chart-bar"></i> Laporan</a>
      <a class="active" href="pengaturan.php" id="fa"><i class="fas fa-cog"></i> Pengaturan</a>
      <a href="../detail.php?id=<?php echo $user['id']; ?>" id="fa" class="lts"><i class="fas fa-store"></i> Lihat Toko Saya</a>
      <a href="logout.php" id="fa" class="lgo"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="content">
      <div class="title-card">
        <h1>Pengaturan</h1>
      </div>
      <div class="table-container">
        <main>


          <form method="POST" class="from" enctype="multipart/form-data">

            <section id="update-notification">
              <?php if (!empty($update_message)): ?>
                <div class="alert">
                  <p style="color: #32CD32;"><?php echo $update_message; ?></p>
                </div>
              <?php endif; ?>
            </section><br>

            <label for="merchant_name" style="font-size: 20px;">Nama Merchant:</label>
            <input type="text" id="merchant_name" name="merchant_name" placeholder="Nama merchant"
              value="<?php echo $user['merchant_name']; ?>" required><br>


            <div class="container5"><label for="profile_picture" style="font-size: 20px;">Gambar Profil:</label>
              <div class="card8">
                <div class="circle"><img class="img" src="<?php echo $user['profile_picture']; ?>"
                    alt="Profile Picture"><br></div>
                <div class="rectangles">
                  <div class="rectangle">
                    <a class="file" href="<?php echo $user['profile_picture']; ?>" target="_blank">Lihat Gambar</a>
                  </div>
                  <div class="rectangle" name="profile_picture">
                    <input type="file" id="file-upload" name="profile_picture">
                    <label for="file-upload" class="file">Upload file</label>
                  </div>
                </div>
              </div>
              <label for="main_image" style="font-size: 20px;" class="ip">Gambar Utama:</label>
              <div class="card8">
                <div class="circle"><img class="img2" src="<?php echo htmlspecialchars($user['main_image']); ?>"
                    alt="Main Image"><br>
                </div>
                <div class="rectangles">
                  <div class="rectangle">
                    <a class="file" href="<?php echo htmlspecialchars($user['main_image']); ?>" target="_blank">Lihat
                      Gambar</a>
                  </div>
                  <div class="rectangle" name="main_image">
                    <input type="file" id="file-upload-main" name="main_image">
                    <label for="file-upload-main" class="file">Upload file <br> </label>
                  </div>
                </div>
              </div>
            </div>



            <br>

            <br>
            <label for="description" style="font-size: 20px;" class="ip">Bio:</label>
            <textarea required id="description" name="description"><?php echo $user['description']; ?></textarea><br>

            <label for="alamat" style="font-size: 20px;">Alamat:</label>
            <textarea required id="alamat" name="alamat"><?php echo $user['alamat']; ?></textarea><br>

            <label for="operation_hours" style="font-size: 20px;">Jam Operasional:</label>
            <input required type="text" id="operation_hours" name="operation_hours"
              value="<?php echo $user['operation_hours']; ?>"><br>

            <label for="phone" style="font-size: 20px;">Telepon:</label>
            <input required type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>"><br>

            <label for="social_media" style="font-size: 20px;">Sosial Media:</label>
            <input required type="text" id="social_media" name="social_media" value="<?php echo $user['social_media']; ?>"><br>

            <label for="website" style="font-size: 20px;">Website:</label>
            <input required type="text" id="website" name="website" value="<?php echo $user['website']; ?>"><br>

            <label for="maps_pin" style="font-size: 20px;">Pin Lokasi (Google Maps):</label>
            <input type="text" id="maps_pin" name="maps_pin" value="<?php echo $user['maps_pin']; ?>"><br>

            <button type="submit" class="masukpakeko">Submit</button>
          </form>
          <br><br>
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

  <script src="./assets/js/script.js"></script>

</body>

</html>