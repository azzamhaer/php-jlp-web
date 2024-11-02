<?php
// Memulai sesi
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['username'])) {
    // Jika sudah login, redirect ke dashboard.php
    header("Location: dashboard.php");
    exit();
}

// Menampilkan pesan kesalahan jika ada
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Merchant Area - JLP</title>
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/login-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="shortcut icon" href="../assets/images/logo.png">
  
</head>
<body>


    <!-- baru2 -->
    <div class="container">
      <div class="back-button">
        <a href="../index.php" style="color: black;"><i class="fas fa-arrow-left"></i></a>
      </div>
      <div class="forms-container">
        <div class="signin-signup">
          <form action="process.php" method="POST" class="sign-in-form">
            <h2 class="title">Masuk</h2>
            <?php if ($message): ?>
             <center><p style="color: Red; margin-top: 20px; "><b><?php echo $message; ?></b></p></center><br>
            <?php endif; ?>
            <div class="input-field">
              <i class="uil uil-user"></i>
              <input type="text" name="username" placeholder="Masukkan Username" autocomplete="off" required />
            </div>
            <div class="input-field">
              <i class="uil uil-lock icon"></i>
              <input  type="password" name="password" placeholder="Masukkan Password" required />
            </div>
            <input  type="submit" name="login" class="btn" value="Login" />
            <!-- <p class="social-text">Atau dengan platform sosial</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="uil uil-facebook icon-facebook"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="uil uil-google icon-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="uil uil-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="uil uil-apple"></i>
              </a>
            </div> -->
          </form>
          <form action="process.php" method="POST" class="sign-up-form ">
            <h2 class="title">Daftar</h2>
            
            <div class="input-field">
              <i class="uil uil-user"></i>
              <input type="text" name="username" placeholder="Buat Username Anda" autocomplete="off" required />
            </div>
            <div class="input-field">
              <i class="uil uil-lock icon"></i>
              <input  type="password" name="password" placeholder="Buat Password Anda" required />
            </div>
            <input  type="submit" name="signup" class="btn" value="Signup" />
            <!-- <p class="social-text">Atau dengan platform sosial</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="uil uil-facebook icon-facebook"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="uil uil-google icon-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="uil uil-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="uil uil-apple"></i>
              </a>
            </div> -->
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>belum jadi member kami ?</h3>
            <p>Daftarkan akunmu menjadi merchant sekarang juga, dan jadilah bagian dari komunitas kami!</p>
            <button class="btn transparent" id="sign-up-btn">Daftar</button>
          </div>
          <img src="assets/images/login.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Sudah jadi member kami ?</h3>
            <p>Login akun merchant sekarang, untuk melanjutkan penghasilanmu bersama kami!</p>
            <button class="btn transparent" id="sign-in-btn">masuk</button>
          </div>
          <img src="assets/images/signup.png" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>
</html>