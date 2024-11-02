<?php
include '../../account/db.php';

if (isset($_POST['search_keyword'])) {
    $keyword = mysqli_real_escape_string($conn, $_POST['search_keyword']);

    // Query untuk mencari merchant berdasarkan keyword
    $query = "SELECT id, profile_picture, main_image, merchant_name, operation_hours, description FROM merchants 
              WHERE tujuan = 'pusat_belanja' AND merchant_name LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $profile_picture = $row['profile_picture'];
            $merchant_name = $row['merchant_name'];
            $operation_hours = $row['operation_hours'];
            $description = $row['description'];
            $randomDistance = rand(40, 50) / 10.0; // Random distance generator
            echo "
            <div class='kuliner-list'>
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
    } else {
        echo "<p class='notfound'>Tidak ada destinasi ditemukan.</p>";
    }
}
