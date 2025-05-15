<?php
session_start();

// Cek jika data tidak lengkap
if (empty($_POST['email']) || empty($_POST['password'])) {
    die("Email dan password harus diisi.");
}

$email = $_POST['email'];
$password = $_POST['password'];

// Koneksi ke database
include 'koneksi.php';

// Cek di tabel admin
$sql_admin = "SELECT * FROM admin WHERE email = ? AND password = ?";
$stmt_admin = $conn->prepare($sql_admin);
$stmt_admin->bind_param("ss", $email, $password);
$stmt_admin->execute();
$result_admin = $stmt_admin->get_result();

// Cek di tabel pengunjung
$sql_pengunjung = "SELECT * FROM pengunjung WHERE email = ? AND password = ?";
$stmt_pengunjung = $conn->prepare($sql_pengunjung);
$stmt_pengunjung->bind_param("ss", $email, $password);
$stmt_pengunjung->execute();
$result_pengunjung = $stmt_pengunjung->get_result();

// Admin Login
if ($result_admin->num_rows === 1) {
    $data = $result_admin->fetch_assoc();

    $_SESSION['admin'] = [
        'nip' => $data['nip'],
        'nama_lengkap' => $data['nama_lengkap'],
        'jabatan'      => $data['jabatan'],
        'foto'         => $data['foto'],
        'email'        => $data['email'],
        'nomor_telepon'        => $data['nomor_telepon'],
        'jam_operasional'        => $data['jam_operasional'] // untuk ambil data saat buka profil_admin.php
    ];

    header("Location: home_admin.php");
    exit;

    // Pengunjung Login
} elseif ($result_pengunjung->num_rows === 1) {
    $data = $result_pengunjung->fetch_assoc();

    $_SESSION['pengunjung'] = [
        'nama_lengkap' => $data['nama_lengkap'],
        'email' => $data['email'],
        'foto' => $data['foto'],
        'nik' => $data['nik'],
        'pendidikan_terakhir' => $data['pendidikan_terakhir'],
        'pekerjaan' => $data['pekerjaan'],
        'alamat' => $data['alamat']
    ];


    header("Location: index.php");
    exit;
} else {
    echo "<script>alert('Email atau kata sandi salah.'); window.location.href='login.php';</script>";
}
