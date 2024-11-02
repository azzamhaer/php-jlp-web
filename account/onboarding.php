<?php
// Memulai sesi
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Onboarding...</title>
    <link rel="shortcut icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/onboarding.css">
    <style>
        .container {
            max-width: 600px;
            margin: auto;
            overflow: hidden;
            position: relative;
        }

        /* Progress Bar */
        #progressbar {
            display: flex;
            justify-content: space-between;
            list-style-type: none;
            counter-reset: step;
            padding: 0;
            margin-bottom: 30px;
            padding-top: 30px;
        }

        #progressbar li {
            position: relative;
            text-align: center;
            flex-grow: 1;
        }

        #progressbar li::before {
            content: counter(step);
            counter-increment: step;
            width: 30px;
            height: 30px;
            border: 2px solid #ddd;
            display: block;
            text-align: center;
            margin: 0 auto 10px;
            border-radius: 50%;
            background-color: white;
            line-height: 30px;
            margin-top: 10px;
        }


        #progressbar li.active::before {
            border-color: #04AA6D;
            background-color: #04AA6D;
            color: white;
        }

        .form-slide {
            min-width: 100%;
            float: left;
            transition: transform 0.5s ease;
            opacity: 0;
            transform: translateX(100%);
            position: absolute;
        }

        .form-slide.active {
            opacity: 1;
            transform: translateX(0);
            position: relative;
        }

        @media (max-width: 768px) {
            .bt1{
                margin-top: -70px;
            }
            .bt2{
                margin-top: -80px;
            }
        }

        @media (min-width: 769px) {
            .bt1{
                margin-top: -70px;
            }
            .bt2{
                margin-top: -80px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="heads">
            <h1>Ceritakan sedikit tentang diri Anda...</h1>
            <p>Kami akan menggunakan jawaban Anda untuk membantu Anda mendapatkan hasil maksimal dari aplikasi kami.</p><br><br>
        </div>

        <!-- Progress bar -->
        <ul id="progressbar">
            <li class="active">Nama</li>
            <li><p class="bt1">Email</p></li>
            <li>Telepon</li>
            <li><p class="bt1">Alamat</p></li>
            <li>Tujuan</li>
            <li><p class="bt2">Referral</p></li>
        </ul>

        <form id="onboardingForm" class="slide" action="save_onboarding.php" method="POST">
            <!-- Slide 1 -->
            <div class="form-slide active">
                <h2>Apa nama merchant Anda?</h2>
                <input type="text" autocomplete="off" placeholder="Minimal 3 huruf..." id="merchant_name" name="merchant_name" required oninput="validateForm()">
                <input type="button" value="Next" id="btn1" disabled onclick="nextSlide()">
            </div>
            <!-- Slide 2 -->
            <div class="form-slide">
                <h2>Apa Email Anda?</h2>
                <input type="email" autocomplete="off" placeholder="anda@email.com" id="email" name="email" required oninput="validateForm()">
                <input type="button" value="Next" id="btn2" disabled onclick="nextSlide()">
            </div>
            <!-- Slide 3 -->
            <div class="form-slide">
                <h2>Siapa nomor yang bisa dihubungi?</h2>
                <input type="tel" autocomplete="off" placeholder="Wajib diawali 62" id="phone" name="phone" required oninput="validateForm()">
                <input type="button" value="Next" id="btn3" disabled onclick="nextSlide()">
            </div>
            <!-- Slide 4 -->
            <div class="form-slide">
                <h2>Ketikkan alamat bisnis Anda</h2>
                <input type="text" autocomplete="off" placeholder="Alamat lengkap..." id="alamat" name="alamat" required oninput="validateForm()">
                <input type="button" value="Next" id="btn4" disabled onclick="nextSlide()">
            </div>
            <!-- Slide 5 -->
            <div class="form-slide">
                <h2>Apa tujuan bisnis Anda?</h2>
                <select name="tujuan" autocomplete="off" id="tujuan" required oninput="validateForm()">
                    <option value="destinasi_populer">Destinasi Populer</option>
                    <option value="kuliner">Kuliner</option>
                    <option value="wisata_pantai">Wisata Pantai</option>
                    <option value="wisata_alam">Wisata Alam</option>
                    <option value="penginapan">Penginapan</option>
                    <option value="pusat_belanja">Pusat Belanja</option>
                    <option value="sewa_transportasi">Sewa Transportasi</option>
                    <option value="event_festival">Event & Festival</option>
                </select><br><br>
                <input type="button" value="Next" id="btn5" disabled onclick="nextSlide()">
            </div>
            <!-- Slide 6 -->
            <div class="form-slide">
                <h2>Masukkan kode referral</h2>
                <input type="text" autocomplete="off" placeholder="" id="referral" name="referral" required oninput="validateForm()">
                <input type="submit" id="btn6" value="Submit" disabled>
            </div>
        </form>
    </div>

    <script>
        let currentSlide = 0;

function nextSlide() {
    const slides = document.querySelectorAll(".form-slide");
    const progressBarSteps = document.querySelectorAll("#progressbar li");

    // Set slide dan progress bar saat ini ke aktif dan jangan menghapus kelas `active` dari langkah sebelumnya
    slides[currentSlide].classList.remove("active");
    currentSlide++;
    slides[currentSlide].classList.add("active");

    // Tambahkan kelas `active` pada semua progress bar langkah yang telah dilalui
    for (let i = 0; i <= currentSlide; i++) {
        progressBarSteps[i].classList.add("active");
    }
}


        function validateForm() {
            const merchantName = document.getElementById('merchant_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const tujuan = document.getElementById('tujuan').value.trim();
            const referral = document.getElementById('referral').value.trim();

            // Validasi Nama Merchant (Minimal 3 huruf)
            const isMerchantNameValid = merchantName.length >= 3;
            document.getElementById('btn1').disabled = !isMerchantNameValid;

            // Validasi Email (format email yang benar)
            const isEmailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            document.getElementById('btn2').disabled = !isEmailValid;

            // Validasi Nomor Telepon (hanya angka)
            const isPhoneValid = /^\d+$/.test(phone);
            document.getElementById('btn3').disabled = !isPhoneValid;

            // Validasi Alamat (Minimal 5 huruf)
            const isAlamatValid = alamat.length >= 5;
            document.getElementById('btn4').disabled = !isAlamatValid;

            // Validasi Tujuan (Minimal 1 huruf)
            const isTujuanValid = tujuan.length >= 1;
            document.getElementById('btn5').disabled = !isTujuanValid;

            // Validasi Referral (Minimal 1 huruf)
            const isReferralValid = referral.length >= 1;
            document.getElementById('btn6').disabled = !isReferralValid;
        }
    </script>

</body>

</html>