<?php
include '../../account/db.php';

if (isset($_POST['search_keyword'])) {
    $keyword = mysqli_real_escape_string($conn, $_POST['search_keyword']);

    // Query untuk mencari produk berdasarkan keyword
    $query = "SELECT p.id, m.merchant_name, m.profile_picture, p.merchant_id, p.nama_produk, p.gambar_produk, m.description, m.operation_hours 
              FROM produk p
              JOIN merchants m ON p.merchant_id = m.id
              WHERE p.nama_produk LIKE '%$keyword%' AND m.tujuan = 'sewa_transportasi'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $operation_hours = $row['operation_hours'];
            $description = $row['description'];
            $randomDistance = rand(40, 50) / 10.0; // Random distance generator
            $merchant_name = $row['merchant_name'];
            $merchant_id = $row['merchant_id'];
            $profile_picture = $row['profile_picture'];
            $gambar_produk = $row['gambar_produk'];
            $nama_produk = $row['nama_produk'];
            echo "
            <div class='kuliner-list'>
                <a href='../../detail.php?id=$merchant_id'>
                    <div class='kuliner-item'>
                        <img src='../../account/uploads/$gambar_produk' alt='$nama_produk' class='kuliner-image'>
                        <div class='kuliner-info'>
                            <h2>$nama_produk</h2>
                            <p>$description</p>
                            <div class='rating'>
                                <span>⭐ $randomDistance</span>
                                <span class='distance'>$merchant_name</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <br>";
        }
    } else {
        echo "<p class='notfound'>Tidak ada produk ditemukan.</p>";
    }
}
