<?php
// Memulai sesi
session_start();
include 'db.php';

// Proses Signup
if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Cek apakah username sudah terdaftar
    $check_query = "SELECT * FROM merchants WHERE username = '$username'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Jika username sudah ada
        $_SESSION['message'] = "Username sudah terdaftar!";
        header("Location: index.php");
        exit();
    } else {
        // Jika username belum ada, proses signup
        $query = "INSERT INTO merchants (username, password) VALUES ('$username', '$password')";

        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Signup berhasil!";
        } else {
            $_SESSION['message'] = "Signup gagal: " . mysqli_error($conn);
        }
        header("Location: index.php");
        exit();
    }
}

// Proses Login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query untuk mendapatkan informasi user berdasarkan username
    $query = "SELECT * FROM merchants WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Jika user ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set sesi untuk user yang berhasil login
            $_SESSION['username'] = $user['username'];
            $_SESSION['merchant_id'] = $user['id']; // Menyimpan merchant_id di sesi
            $_SESSION['is_logged_in'] = true; // Menyimpan status login

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['message'] = "Password salah!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Username tidak ditemukan!";
        header("Location: index.php");
        exit();
    }
}

mysqli_close($conn);
