<!DOCTYPE html>
<html lang="en">

<?php

$param = $_GET['id'];

require_once('../account/db.php');

function news($conn)
{
    $db = 'news';
    $query = "SELECT * FROM $db";

    $result = mysqli_query($conn, $query);

    return $result;
}

function news_by_id($conn, string $id)
{
    $db = 'news';
    $query = "SELECT * FROM $db WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    return $result;
}



$get_news_by_id = news_by_id($conn, $param);
$news = mysqli_fetch_assoc($get_news_by_id);
$get_news = news($conn);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $news['title'] ?></title>
    <link rel="stylesheet" href="../assets/css/news.css">
    <link rel="shortcut icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* Aspect ratio 16:9 */
            height: 0;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-left: 20px;
            margin-right: 20px
        }

        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 20px;
            object-fit: cover;

        }
    </style>
</head>



<body>
    <div class="container">
        <div class="header">
            <div class="back-button">
                <a href="../index.php#news" style="color: black;"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h2><?= $news['title'] ?></h2>
        </div>
        <div class="video-container">
            <video controls>
                <source src="videos/<?= $param ?>.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="news-content">
            <div class="sub">
                <div class="vertical-line"></div>
                <div class="news-footer">
                    <p>By <a href="#">JLP Admin</a></p>
                    <p>Published On 31 Aug 2024</p>
                </div>
            </div>
            <?= $news['content'] ?><br><br>
            <a href="https://app.midtrans.com/payment-links/1730294866929"><button class="button-3" role="button">Donasi Sekarang!</button></a>
        </div>
        <div class="other-news">
            <h2>Other News</h2>

            <?php
            while ($news = mysqli_fetch_assoc($get_news)) {
            ?>

                <div class="news-card">
                    <img src="images/<?= $news['id'] ?>.jpg" alt="" loading="lazy">
                    <div class="text-content">
                        <a href="article.php?id=<?= $news['id'] ?>"><?= $news['title'] ?></a>
                        <p><?= $news['content'] ?></p>  
                    </div>
                    
                </div>

            <?php } ?>
        </div>
    </div>
</body>

</html>