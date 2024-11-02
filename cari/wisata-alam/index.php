<?php
// Start session and include the database connection
session_start();
include '../../account/db.php'; // Pastikan file ini berisi koneksi database

// Query untuk mendapatkan data merchant (id, profile_picture, main_image, merchant_name)
$query = "SELECT id, profile_picture, main_image, merchant_name, operation_hours, description FROM merchants WHERE tujuan = 'wisata_alam'";
$result = mysqli_query($conn, $query);
?>

<?php
// Fungsi untuk menghasilkan angka random dalam format "4,0" hingga "5,0"
function generateRandomDistance()
{
    // Menghasilkan angka random float antara 4.0 dan 5.0
    $randomFloat = rand(40, 50) / 10.0;
    // Format angka menjadi "4,0" hingga "5,0"
    return number_format($randomFloat, 1, ',', '');
}

// Menyimpan hasil random distance ke dalam variabel
$randomDistance = generateRandomDistance();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Alam - JLP</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../menu-mus.css">
    <link rel="stylesheet" href="../../assets/css/sticky.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="../../assets/js/shadow-add-when-scroll.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <div class="back-button">
                <a href="../../index.php#menu-tiles" style="color: black;"><i class="fas fa-arrow-left"></i></a>
            </div>
            <img src="../../assets/images/menu-images/alam.webp" alt="Tugu Jogja" class="header-image">
            <div class="header-content">
                <h1>Wisata Alam</h1>
                <p>Jelajahi wisata alam yang penuh petualangan!</p>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter sticky" id="searchFilter">
            <div class="search-bar">
                <input type="text" id="searchInput" name="search_keyword" placeholder="Cari tempat wisata alam..." autocomplete="off">
            </div>
        </div>

        <!-- Kuliner List -->
        <div id="kuliner-container">
            <?php
            // Check if there are merchants in the result
            if (mysqli_num_rows($result) > 0) {
                // Loop through all the merchants and display them
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $profile_picture = $row['profile_picture'];
                    $merchant_name = $row['merchant_name'];
                    $operation_hours = $row['operation_hours'];
                    $description = $row['description'];

                    // Hanya tampilkan merchant jika merchant_name tidak kosong
                    if (!empty($merchant_name)) {
                        echo "
                    <div class='kuliner-list' style='display: none;'>
                        <a href='../../detail.php?id=$id'>
                            <div class='kuliner-item'>
                                <img src='../../account/$profile_picture' alt='$merchant_name' class='kuliner-image'>
                                <div class='kuliner-info'>
                                    <h2>$merchant_name</h2>
                                    <p>$description</p>
                                    <div class='rating'>
                                        <span>⭐ $randomDistance</span>
                                        <span class='distance'>$operation_hours</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <br>";
                    }
                }
            } else {
                echo "<p class='notfound'>Tidak ada destinasi ditemukan.</p>";
            }
            ?>
        </div>
        <div id="loading" style="display: none; text-align: center;">
            <img src="../../assets/gif/loading.gif" alt="Loading..." width="50px" />
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const kulinerItems = document.querySelectorAll('.kuliner-list');
        let itemsToShow = 5; // Number of items to show initially
        let currentIndex = 0; // Initial index
        let isLoading = false;

        function showItems() {
            for (let i = currentIndex; i < currentIndex + itemsToShow && i < kulinerItems.length; i++) {
                kulinerItems[i].style.display = 'block';
            }
            currentIndex += itemsToShow;

            if (currentIndex >= kulinerItems.length) {
                $('#loading').hide();
            } else {
                isLoading = false;
            }
        }

        // Show first set of items on page load
        showItems();

        // Infinite scroll logic
        window.addEventListener('scroll', function() {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100 && !isLoading) {
                isLoading = true;
                $('#loading').show();
                setTimeout(function() {
                    showItems();
                    $('#loading').hide();
                }, 1000);
            }
        });

        // AJAX Search logic
        $('#searchInput').on('input', function() {
            let searchKeyword = $(this).val();

            $('#loading').show();

            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: {
                    search_keyword: searchKeyword
                },
                success: function(response) {
                    $('#kuliner-container').html(response);
                    $('#loading').hide();
                },
                error: function() {
                    $('#kuliner-container').html('<p class="notfound">Terjadi kesalahan. Coba lagi nanti.</p>');
                    $('#loading').hide();
                }
            });
        });
    });
</script>

</html>