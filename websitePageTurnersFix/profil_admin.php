<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Ambil data admin dari session
$admin = $_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navbar -->
    <header>
        <?php include 'navbar_admin.php'; ?>
    </header>

    <!-- Konten Admin -->
    <div class="profil">
        <main class="profil-main">
            <h2 class="profil-salam">Hallo, <?= htmlspecialchars($admin['nama_lengkap']) ?>!</h2>
            <p class="profil-pesan">Selamat datang di halaman profil Anda. Sebagai Admin, Anda memiliki akses untuk mengelola konten, memonitor aktivitas pengguna, dan memastikan kelancaran sistem. Pastikan untuk memeriksa dan memperbarui data penting secara berkala untuk menjaga kualitas pelayanan.</p>

            <div class="profil-biodata">
                <div class="profil-foto">
                    <img src="<?= $fotoAdmin ?>" alt="Foto Admin">
                </div>

                <div class="profil-info">
                    <h3>📋 Biodata</h3>

                    <div class="form-group">
                        <div class="label-box">NIP</div>
                        <div class="value-box"><?= htmlspecialchars($admin['nip']); ?></div>
                    </div>
                    <div class="form-group">
                        <div class="label-box">Email</div>
                        <div class="value-box"><?= htmlspecialchars($admin['email']); ?></div>
                    </div>
                    <div class="form-group">
                        <div class="label-box">Nama</div>
                        <div class="value-box"><?= htmlspecialchars($admin['nama_lengkap']); ?></div>
                    </div>
                    <div class="form-group">
                        <div class="label-box">Jabatan</div>
                        <div class="value-box"><?= htmlspecialchars($admin['jabatan']); ?></div>
                    </div>
                    <div class="form-group">
                        <div class="label-box">No Telpon</div>
                        <div class="value-box"><?= htmlspecialchars($admin['nomor_telepon']); ?></div>
                    </div>
                    <div class="form-group">
                        <div class="label-box">Jam Operasional</div>
                        <div class="value-box"><?= htmlspecialchars($admin['jam_operasional']); ?></div>
                    </div>
                </div>
            </div>
            <a href="logout.php" class="keluar">Keluar</a>
        </main>
    </div>
</body>

</html>