<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jogja Love Palestine</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="assets/images/logo.png">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/plus.css">
  <link rel="stylesheet" href="./assets/css/in-assoc.css">
  <link rel="stylesheet" href="./assets/css/slider.css">
  <link rel="stylesheet" href="./assets/css/nav.css">  
  <link rel="stylesheet" href="./assets/css/search.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" />
  

  
  
</head>

<?php

require_once('./account/db.php');
require_once('./functions/get.php');

$get_news = news($conn);

?>


<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>


    <div class="overlay" data-overlay></div>

    <div class="header-top">
      <div class="container">

        <a href="tel:+628161123811" class="helpline-box">

          <div class="icon-box">
            <ion-icon name="call-outline"></ion-icon>
          </div>

          <div class="wrapper">
            <p class="helpline-title">Kontak kami</p>

            <p class="helpline-number">+62 816 1123 811</p>
          </div>

        </a>

        <a href="#" class="logo">
          <img src="./assets/images/logo.png" alt="logo">
        </a>

        <div class="header-btn-group">

          <!-- <button class="search-btn" aria-label="Search">
        <ion-icon name="search"></ion-icon>
      </button> -->

          <a href="https://app.midtrans.com/payment-links/1730294866929" class="btn btn-primary btn-merchant">DONASI</a>


        </div>

      </div>
    </div>


    <div class="bottom-navbar">
      <div class="con-effect">
        <div class="effect"></div>
      </div>
      <a href="index.php#home" class="active">
        <button>
          <i class="bx bx-home"></i>
          <span>Home</span> <!-- Teks penjelas -->
        </button>
      </a>
      <a href="index.php#about">
        <button>
          <i class="bx bx-info-circle"></i>
          <span>Tentang </span> <!-- Teks penjelas -->
        </button>
      </a>
      <a href="laporan" class="float">
        <button>
          <i class="bx bx-file"></i>
          <span>Laporan</span> <!-- Teks penjelas -->
        </button>
      </a>
      <a href="index.php#contact">
        <button>
          <i class="bx bx-phone"></i>
          <span>Contact</span> <!-- Teks penjelas -->
        </button>
      </a>
      <a href="account/index.php">
        <button>
          <i class="bx bx-log-in"></i>
          <span>Login</span> <!-- Teks penjelas -->
        </button>
      </a>
    </div>

  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home">
        <div class="container-fluid " >

        <h2 class="section-title-hero" style="color: white;"> Hai kamu, mau ke mana?</h2>
        
        <form class="tour-search-form-hero">
          <div class="input-wrapper">
            <i class="bx bx-search" id="search-icon"></i>
            <input type="text" id="search" required placeholder="" class="input-field" autocomplete="off"></input>
            <div id="search-results"></div>
            <div class="placeholder" id="placeholder"></div>
          </div>  
        </form>


        <div class="menu-container-hero">

          <a href="cari/destinasi-populer" class="menu-item-hero">
            <div class="img-icon">
              <img  src="assets/images/menu-icon/camera.webp" alt="Destinasi Populer">
            </div>
            
            <p>Destinasi Populer</p>
          </a>
          <a href="cari/kuliner" class="menu-item-hero">
            <div class="img-icon">
              <img src="assets/images/menu-icon/burger.webp" alt="Kuliner">
            </div>
            
            <p>Kuliner</p>
          </a>
          <a href="cari/wisata-pantai" class="menu-item-hero">
            <div class="img-icon">
              <img src="assets/images/menu-icon/beach-umbrella.webp" alt="Wisata Pantai">
            </div>
            
            <p>Wisata Pantai</p>
          </a>
          <a href="cari/wisata-alam" class="menu-item-hero">
            <div class="img-icon">
              <img src="assets/images/menu-icon/mountain.webp" alt="Wisata Alam">
            </div>
            
            <p>Wisata Alam</p>
          </a>
          <a href="cari/penginapan" class="menu-item-hero">
            <div class="img-icon">
              <img src="assets/images/menu-icon/motel.webp" alt="Penginapan">
            </div>
            
            <p>Penginapan</p>
          </a>
          <a href="cari/pusat-belanja" class="menu-item-hero">
            <div class="img-icon">
              <img src="assets/images/menu-icon/shop.webp" alt="Pusat Belanja">
            </div>
            <p>Pusat Belanja</p>
          </a>
          <a href="cari/sewa-transportasi" class="menu-item-hero">
            <div class="img-icon">
              <img src="assets/images/menu-icon/transport.webp" alt="Sewa Transportasi">
            </div>
            <p>Sewa Transportasi</p>
          </a>
          <a href="cari/event-festival" class="menu-item-hero">
            <div class="img-icon">
               <img src="assets/images/menu-icon/location-pin.webp" alt="Event & Festival">
            </div>
            
            <p>Event & Festival</p>
          </a>
        </div>

        </div>
      </section>

      <!-- about -->
      <section class="cta" id="about">
        <div class="container" >
          
          <div class="cta-content">
            <p class="section-subtitle">Tentang</p>

            <h2 class="h2 section-title">Jogja Love Palestine</h2>

            <p class="section-text-about">
            <b>Jogja Love Palestine</b> adalah platform unik yang menggabungkan wisata, bisnis, dan amal dalam satu genggaman! 
            Dikembangkan oleh <b>Sekolah Impian</b> dan didukung oleh <b>KNRP</b>, 
            <b>Jogja Love Palestine</b> mengajak Anda menikmati keindahan Yogyakarta sekaligus berkontribusi untuk kemanusiaan.

            </p>
            <p class="section-text-about">
            Dengan menjelajahi destinasi kuliner, budaya, dan lokasi populer di Yogyakarta melalui website <b>Jogja Love Palestine</b> ini, 
            1% dari setiap transaksi Anda akan disalurkan untuk membantu saudara-saudara kita di Palestina. 
            Setiap kegiatan Anda selama di Jogja akan menjadi lebih bermakna.
            
            </p>
            <p class="section-text-about">
            Bersama <b>Jogja Love Palestine</b>, jadikan setiap langkah liburan Anda berharga. 
            Wisata jadi seru, bisnis lokal bertumbuh, dan kepedulian terwujud!</b>
            
            </p>
          </div>
          <div class="img-about">
            <img class="about-img" src="assets/images/gallery-3.jpg" alt="">
            <img class="about-img2" src="assets/images/gallery-5.jpg" alt="">
            <img class="about-img3" src="assets/images/search.jpg" alt="">
          </div>
        </div>
      </section>



      <!-- 
        - #NEWS SECTION
      -->

      <section class="popular" id="news">
        <div class="container">


          <p class="section-subtitle">Hot News</p>

          <h2 class="h2 section-title">Berita Palestina</h2>

          <p class="section-text">
            Dapatkan informasi terbaru tentang kondisi Palestina dengan berita terkini yang
            akurat dan tepercaya langsung dari sumber resmi.
          </p>

          <div class="scroll-container">
            <ul class="popular-list">

              <?php
              while ($news = mysqli_fetch_assoc($get_news)) {
              ?>

                <li>
                  <div class="popular-card">

                    <figure class="card-img">
                      <img src="news/images/<?= $news['id'] ?>.webp" alt="" loading="lazy">
                    </figure>

                    <div class="card-content">
                      <a href="news/article.php?id=<?= $news['id'] ?>">
                        <p class="card-subtitle">
                          31 Agustus 2024
                        </p>

                        <p class="card-text">
                          <b><?= $news['title'] ?></b>
                        </p>
                      </a>
                    </div>

                  </div>
                </li>

              <?php } ?>
            </ul>
          </div>

          <!-- <button class="btn btn-primary">BACA LAINNYA</button> -->

        </div>
      </section>

      <!-- 
        - #CTA
      -->

      <section class="cta" id="contact">
        <div class="container">

          <div class="cta-content">
            <p class="section-subtitle">Call To Action</p>

            <h2 class="h2 section-title">Butuh informasi lebih lanjut? kontak kami!</h2>

            <p class="section-text">
              Untuk informasi lebih lanjut, pertanyaan, atau bantuan, jangan ragu menghubungi kami melalui email, telepon, atau media sosial.
              Tim kami siap membantu dengan cepat dan responsif.
            </p>
          </div>

          <button class="btn btn-secondary" id="contactBtn">Add contact!</button>

          <div id="contactModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <h2>Kontak Kami</h2>
              <br>
              <p><strong>WhatsApp:</strong>+62 816 1123 811</p>
              <p><strong>Email:</strong> info@jogjalovepalestine.com</p>
              <p><strong>Address:</strong>Tenjolaya, Bogor 16371</p>
              <br>
              <h3>Our Location</h3>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126827.45301492902!2d106.67660260564473!3d-6.602367532187335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69d1027ef9ea39%3A0x8bc33d5bc117c098!2sQuadrant%20Boarding%20School%20(QBS)!5e0!3m2!1sid!2sid!4v1726924198354!5m2!1sid!2sid" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </section>
        <br><br>
        <div class="container-logo">
          <h3>In Association With :</h3>
          <div class="logo-container">
            <img src="assets/images/knrp.png" alt="KNRP Logo" class="logo">
            <img src="assets/images/logo-si.png" alt="Logo SI" class="logo">
            <img src="assets/images/fq-donasi.png" alt="FQ Donasi Logo" class="logo">
            
          </div>
        </div>
        
      

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">


          <img src="assets/images/logo.png" alt="JLP"><br>


          <p class="footer-text">
            Liburan seru sambil berbagi, dukung Palestina dengan mengeksplorasi keindahan Yogyakarta.
            Bersama kita berwisata dengan tujuan dan makna lebih.
          </p>

        </div>

        <div class="footer-contact">

          <h4 class="contact-title">Kontak kami</h4>

          <p class="contact-text">
            Jangan ragu untuk menghubungi kami
          </p>

          <ul>

            <li class="contact-item">
              <ion-icon name="call-outline"></ion-icon>

              <a href="tel:+628161123811" class="contact-link">+62 816 1123 811</a>
            </li>

            <li class="contact-item">
              <ion-icon name="mail-outline"></ion-icon>

              <a href="mailto:info@jogjalovepalestine.com" class="contact-link">info@jlp.my.id</a>
            </li>

            <li class="contact-item">
              <ion-icon name="location-outline"></ion-icon>

              <address>Tenjolaya, Bogor 16371</address>
            </li>

          </ul>

        </div>

        <div class="footer-form">

          <p class="form-text">
            Berlangganan buletin kami untuk mendapatkan informasi terbaru
          </p>

          <form action="" class="form-wrapper">
            <input type="email" name="email" class="input-field" placeholder="Masukkan Email Anda" required>

            <button type="submit" class="btn btn-secondary">Subscribe</button>
          </form>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2024 <a href="">Jogja Love Palestine</a>, All rights reserved.
        </p>

        <ul class="footer-bottom-list">

          <li>
            <a href="account/privacy-policy.php" class="footer-bottom-link">Privacy Policy</a>
          </li>

          <li>
            <a href="account/terms.php" class="footer-bottom-link">Terms & Condition</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">FAQ</a>
          </li>

        </ul>

      </div>
    </div>

  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="assets/js/script.js"></script>
  <script src="assets/js/new-mod.js"></script>
  <script src="assets/js/slider.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  

  <script>
    // FOR POPUP CONTACT

    // Get modal and button elements
    var modal = document.getElementById("contactModal");
    var btn = document.getElementById("contactBtn");
    var span = document.getElementsByClassName("close")[0];

    // Show modal when button is clicked
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // Close modal when X is clicked
    span.onclick = function() {
      modal.style.display = "none";
    }

    // Close modal when user clicks outside modal
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    } 
  </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            let query = $(this).val();
            if (query.length > 1) {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: { query: query },
                    success: function(data) {
                        $('#search-results').html(data).show();
                    }
                });
            } else {
                $('#search-results').hide();
            }
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('#search, #search-results').length) {
                $('#search-results').hide();
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>

</body>

</html>