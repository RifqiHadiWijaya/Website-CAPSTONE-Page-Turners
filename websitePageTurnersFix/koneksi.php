<?php
$host = "sql212.infinityfree.com";
$user = "if0_38979040";
$pass = "Y2oFNjw2NQ";
$db = "if0_38979040_perpustakaan";

// Hanya untuk development - debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8mb4"); // Set charset yang aman
} catch (Exception $e) {
    error_log($e->getMessage()); // Log kesalahan
    exit("Terjadi kesalahan koneksi ke database."); // Pesan umum, tidak bocorkan detail
}
