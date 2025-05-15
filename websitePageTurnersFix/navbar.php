<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar">
    <div class="top-bar">
        <img src="https://perpustakaankearsipan.samarindakota.go.id/storage/Template/logo.png" alt="Logo">
    </div>

    <div class="atas">

        <ul class="nav-links">
            <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Beranda</a></li>
            <li><a href="buku.php" class="<?= ($current_page == 'buku.php') ? 'active' : '' ?>">Buku</a></li>
            <li><a href="fasilitas.php" class="<?= ($current_page == 'fasilitas.php') ? 'active' : '' ?>">Fasilitas</a></li>
            <li><a href="user_donasi.php" class="<?= ($current_page == 'user_donasi.php') ? 'active' : '' ?>">Donasi Buku</a></li>
        </ul>

        <?php if (isset($_SESSION['pengunjung'])): ?>
            <a class="masuk" href="profil_pengunjung.php">
                <?php
                $fotoProfil = $_SESSION['pengunjung']['foto'] ? "img/" . $_SESSION['pengunjung']['foto'] : "img/masuk.png";
                ?>
                <img src="<?= $fotoProfil; ?>" alt="Profil" style="width: 30px; height: 30px; border-radius: 50%;">
            </a>
        <?php else: ?>
            <a class="masuk" href="profil_pengunjung.php">
                <img src="img/masuk.png" alt="Logo Masuk" style="width: 25px; height: 25px; vertical-align: middle; margin-right: 5px;">
                Masuk
            </a>
        <?php endif; ?>
    </div>
</nav>