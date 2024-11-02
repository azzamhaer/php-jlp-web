<?php
include 'account/db.php';

if (isset($_POST['query'])) {
    $query = mysqli_real_escape_string($conn, $_POST['query']);
    $output = '';

    // Function to highlight the search term in results
    function highlightTerm($text, $term) {
        return str_ireplace($term, '<strong>' . $term . '</strong>', $text);
    }

    // Search in the merchants table
    $merchantQuery = "SELECT * FROM merchants WHERE merchant_name LIKE '%$query%'";
    $merchantResult = mysqli_query($conn, $merchantQuery);

    if (mysqli_num_rows($merchantResult) > 0) {
        $output .= '<div class="result-category">Toko Terkait</div>';
        while ($row = mysqli_fetch_assoc($merchantResult)) {
            $merchantName = highlightTerm(htmlspecialchars($row['merchant_name']), $query);
            $profilePicture = htmlspecialchars($row['profile_picture']);
            $output .= '<a href="detail.php?id=' . htmlspecialchars($row['id']) . '"><div class="result-item">
                            <img src="account/' . $profilePicture . '" alt="' . $merchantName . '" class="result-image">
                            <p class="brand">' . $merchantName . '</p>
                        </div></a>';
        }
    }

    // Search in the products table and join with merchants to get merchant_id
    $productQuery = "SELECT produk.*, merchants.id AS merchant_id 
                     FROM produk 
                     INNER JOIN merchants ON produk.merchant_id = merchants.id 
                     WHERE produk.nama_produk LIKE '%$query%'";
    $productResult = mysqli_query($conn, $productQuery);

    if (mysqli_num_rows($productResult) > 0) {
        $output .= '<div class="result-category">Produk Terkait</div>';
        while ($row = mysqli_fetch_assoc($productResult)) {
            $productName = highlightTerm(htmlspecialchars($row['nama_produk']), $query);
            $gambarProduk = htmlspecialchars($row['gambar_produk']);
            $output .= '<a href="detail.php?id=' . htmlspecialchars($row['merchant_id']) . '"><div class="result-item">
                            <img src="account/uploads/' . $gambarProduk . '" alt="' . $productName . '" class="result-image">
                            <p class="brand">' . $productName . '</p>
                        </div></a>';
        }
    }

    echo $output ?: '<div class="result-item">Tidak ada hasil ditemukan.</div>';
}

mysqli_close($conn);
?>
