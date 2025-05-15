<?php
include 'koneksi.php';
session_start();

// Inisialisasi favorit jika belum ada
if (!isset($_SESSION['favorit'])) {
    $_SESSION['favorit'] = [];
}

// Tambah atau hapus dari favorit
if (isset($_POST['tambah_favorit'])) {
    $favorit_id = $_POST['favorit_id'];
    if (in_array($favorit_id, $_SESSION['favorit'])) {
        $_SESSION['favorit'] = array_diff($_SESSION['favorit'], [$favorit_id]);
    } else {
        $_SESSION['favorit'][] = $favorit_id;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Katalog Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>


    <div class="layout">
        <aside class="sidebar">
            <ul>
                <li><a href="buku.php?kategori=Terpopuler">📈 Terpopuler</a></li>
                <li><a href="buku.php?kategori=Terbaru">🆕 Terbaru</a></li>
                <hr>
                <li><a href="buku.php?kategori=Agama">Agama</a></li>
                <li><a href="buku.php?kategori=Anak-Anak">Anak-Anak</a></li>
                <li><a href="buku.php?kategori=Sejarah">Sejarah</a></li>
                <li><a href="buku.php?kategori=Novel">Novel</a></li>
                <li><a href="buku.php?kategori=Motivasi">Motivasi</a></li>
            </ul>
        </aside>

        <div class="konten-buku">
            <div class="section-buku">
                <div class="header-buku">
                    <form class="search-form" action="buku.php" method="GET">
                        <input type="text" name="cari" class="search-bar" placeholder="Cari buku..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                        <button type="submit" class="search-btn">🔍</button>
                    </form>
                    <form method="get" style="display:inline;">
                        <input type="hidden" name="favorit" value="1">
                        <button class="favorite-btn" type="submit">❤️</button>
                    </form>
                </div>

                <h2>
                    <?php
                    if (isset($_GET['cari'])) {
                        echo "Hasil pencarian untuk: <em>" . htmlspecialchars($_GET['cari']) . "</em>";
                    } elseif (isset($_GET['kategori'])) {
                        echo htmlspecialchars($_GET['kategori']);
                    } elseif (isset($_GET['favorit'])) {
                        echo "Buku Favorit";
                    } else {
                        echo "Semua Buku";
                    }
                    ?>
                </h2>

                <div class="book-slider">
                    <?php
                    $result = null;

                    if (isset($_GET['favorit'])) {
                        if (!empty($_SESSION['favorit'])) {
                            $ids = implode(',', array_map('intval', $_SESSION['favorit']));
                            $sql = "SELECT id_buku, judul, foto FROM buku WHERE id_buku IN ($ids)";
                            $result = $conn->query($sql);
                        }
                    } elseif (isset($_GET['cari'])) {
                        $keyword = $conn->real_escape_string($_GET['cari']);
                        $sql = "SELECT id_buku, judul, foto FROM buku WHERE judul LIKE '%$keyword%' ORDER BY judul ASC";
                        $result = $conn->query($sql);
                    } elseif (isset($_GET['kategori'])) {
                        $kategori = $conn->real_escape_string($_GET['kategori']);
                        if ($kategori === "Terpopuler") {
                            $sql = "SELECT id_buku, judul, foto FROM buku ORDER BY jumlah_buku DESC LIMIT 10";
                        } elseif ($kategori === "Terbaru") {
                            $sql = "SELECT id_buku, judul, foto FROM buku ORDER BY tahun_terbit DESC LIMIT 10";
                        } else {
                            $sql = "SELECT id_buku, judul, foto FROM buku WHERE kategori LIKE '%$kategori%' ORDER BY judul ASC LIMIT 10";
                        }
                        $result = $conn->query($sql);
                    } else {
                        $sql = "SELECT id_buku, judul, foto FROM buku ORDER BY id_buku DESC LIMIT 10";
                        $result = $conn->query($sql);
                    }

                    if ($result && $result->num_rows > 0) {
                        while ($buku = $result->fetch_assoc()) {
                            include 'card_buku.php';
                        }
                    } else {
                        echo "<p>Tidak ada buku ditemukan.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>