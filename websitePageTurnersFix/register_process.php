<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$name = $_POST['name'];
$nik = $_POST['nik'];
$pekerjaan = $_POST['pekerjaan'];
$alamat = $_POST['alamat'];
$pendidikan = $_POST['pendidikan_terakhir'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validasi password
if ($password !== $confirm_password) {
    $_SESSION['register_error'] = "Konfirmasi kata sandi tidak cocok.";
    header("Location: register.php");
    exit;
}

// Cek apakah email sudah terdaftar
$sql_check = "SELECT * FROM pengunjung WHERE email = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['register_error'] = "Email sudah terdaftar.";
    header("Location: register.php");
    exit;
}

// Simpan password apa adanya (plain text)
$sql_insert = "INSERT INTO pengunjung (nama_lengkap, nik, pekerjaan, alamat, pendidikan_terakhir, email, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("sssssss", $name, $nik, $pekerjaan, $alamat, $pendidikan, $email, $password);

if ($stmt->execute()) {
    $new_user_email = $email;

    // Ambil data pengguna berdasarkan email
    $sql_get_user = "SELECT * FROM pengunjung WHERE email = ?";
    $stmt_user = $conn->prepare($sql_get_user);
    $stmt_user->bind_param("s", $new_user_email);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $pengunjung = $result_user->fetch_assoc();

    // Set session dengan data pengunjung
    $_SESSION['pengunjung'] = $pengunjung;

    header("Location: index.php");
    exit;
} else {
    $_SESSION['register_error'] = "Terjadi kesalahan saat menyimpan data.";
    header("Location: register.php");
    exit;
}
