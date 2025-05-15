<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar">
    <div class="top-bar">
        <img src="https://perpustakaankearsipan.samarindakota.go.id/storage/Template/logo.png" alt="Logo">
    </div>
    <ul class="nav-links">
        <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Beranda</a></li>
        <li><a href="konten_admin.php" class="<?= ($current_page == 'konten_admin.php') ? 'active' : '' ?>">Konten</a></li>
        <li><a href="admin_donasi.php" class="<?= ($current_page == 'admin_donasi.php') ? 'active' : '' ?>">Donasi Buku</a></li>

        <?php if (isset($_SESSION['admin'])): ?>
            <?php
            $admin = $_SESSION['admin'];
            $fotoAdmin = !empty($admin['foto']) ? 'img/' . $admin['foto'] : 'img/pp.png';
            ?>
            <li>
                <a class="masuk" href="profil_admin.php" title="<?= $admin['nama_lengkap']; ?>">
                    <img src="<?= $fotoAdmin; ?>" alt="Foto Admin" style="width: 35px; height: 35px; border-radius: 50%; vertical-align: middle;">
                    <span style="margin-left: 8px; vertical-align: middle;">
                    </span>
                </a>
            </li>

        <?php elseif (isset($_SESSION['user'])): ?>
            <?php
            $pengunjung = $_SESSION['user'];
            $fotoPengunjung = !empty($pengunjung['foto']) ? 'img/' . $pengunjung['foto'] : 'img/pp.png';
            ?>
            <li>
                <a class="masuk" href="index.php" title="<?= $pengunjung['nama']; ?>">
                    <img src="<?= $fotoPengunjung; ?>" alt="Foto Pengunjung" style="width: 35px; height: 35px; border-radius: 50%; vertical-align: middle;">
                    <span style="margin-left: 8px; vertical-align: middle;"><?= $pengunjung['nama']; ?></span>
                </a>
            </li>

        <?php else: ?>
            <li>
                <a class="masuk" href="login.php">
                    <img src="img/masuk.png" alt="Login" style="width: 25px; height: 25px; vertical-align: middle; margin-right: 5px;">
                    Masuk
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>