<?php
// db.php

$host = 'localhost';
$dbname = 'si-jlp';
$username = 'root'; // Sesuaikan dengan username MySQL kamu
$password = ''; // Sesuaikan dengan password MySQL kamu

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
