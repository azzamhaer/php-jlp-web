<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Pending!</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 100px;
        }
        .logo {
            margin-top: 20px;
        }
        .logo img {
            width: 40px;
        }
        .pending-icon {
            font-size: 50px;
            color: #ffc107; /* Warna kuning untuk status pending */
        }
        .message {
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
        }
        .sub-message {
            font-size: 16px;
            color: #6c757d;
            margin-top: 10px;
        }
        .details {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #ffffff;
        }
        .details div {
            margin: 5px 0;
        }
        .details div span {
            font-weight: bold;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #2462ee;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .footer {
            margin-top: 50px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img alt="Jogja Love Palestine" height="40" src="../../assets/images/logo.png" width="40"/>
    </div>
    <div class="container">
        <div class="pending-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="message">
            Donasi Pending
        </div>
        <div class="sub-message">
            Mohon tunggu, kami sedang memproses donasi Anda!
        </div>
        <div class="details" style="background-color: #ffffff;">
            <div>
                <span>Nominal donasi:</span> (Tidak terhingga)
            </div>
            <div>
                <span>Tanggal & Waktu:</span>
                <?php
                date_default_timezone_set('Asia/Jakarta'); // Set timezone to Jakarta
                echo date('F j, Y, h:i A');
                ?>
            </div>
            <div>
                <span>Nomer Referensi:</span>
                <?php
                $randomNumber = sprintf('%04d-%04d-%04d', rand(1000, 9999), rand(1000, 9999), rand(1000, 9999));
                echo $randomNumber;
                ?>
            </div>
        </div>
    </div>
    <a class="button" href="/" style="background-color: #2462ee;">
        Kembali ke Beranda
    </a>
    <div class="footer">
        © 2024 Jogja Love Palestine
    </div>
</body>
</html>