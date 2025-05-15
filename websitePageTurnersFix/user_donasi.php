<?php
session_start();
if (!isset($_SESSION['pengunjung'])) {
    header("Location: login.php");
    exit;
}

// Koneksi database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $judul_buku = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $jumlah_buku = $_POST['jumlah_buku'];
    $kondisi_buku = $_POST['kondisi_buku'];
    $catatan_tambahan = $_POST['catatan_tambahan'] ?? '';

    // Upload foto
    $foto_nama = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $upload_dir = "uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $nama_file = time() . "_" . basename($_FILES["foto"]["name"]);
        $target_file = $upload_dir . $nama_file;
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $foto_nama = $target_file;
        }
    }

    // Pastikan pengunjung sudah login (ada session pengunjung)
    if (!isset($_SESSION['pengunjung'])) {
        die('Pengunjung belum login!');
    }
    $nik = $_SESSION['pengunjung']['nik'];


    // Simpan ke database
    $sql = "INSERT INTO donasi (judul_buku, penulis, kategori, jumlah_buku, kondisi_buku, catatan_tambahan, foto, nik)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Cek apakah prepare gagal
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssisssi", $judul_buku, $penulis, $kategori, $jumlah_buku, $kondisi_buku, $catatan_tambahan, $foto_nama, $nik);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Donasi berhasil dikirim!'); window.location.href='user_donasi.php';</script>";
    } else {
        echo "Gagal menyimpan donasi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Donasi Buku Perpustakaan</title>
    <link rel="stylesheet" href="style.css">

    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fdfaf6;
            margin: 0;
        }

        header {
            margin-bottom: 20px;
        }

        .hero-donasi-admin {
            position: relative;
            background: url('img/donasi.jpg') no-repeat center center/cover;
            height: 350px;
        }

        .hero-donasi-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-donasi-text {
            color: #fff;
            text-align: center;
            padding: 20px;
            max-width: 800px;
        }

        .hero-donasi-text h1 {
            font-size: 36px;
            color: #ffdda1;
            margin-bottom: 10px;
        }

        .donasi-info-box {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fefaf5;
            border-left: 6px solid #c77a36;
            border-radius: 10px;
        }

        .donasi-info-box h3 {
            color: #6a3e1a;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .donasi-info-box ul {
            list-style: disc;
            padding-left: 20px;
        }

        .donasi-info-box p {
            font-size: 15px;
        }

        .form-container {
            width: 90%;
            max-width: 800px;
            background-color: #fffaf4;
            padding: 40px;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .form-container h2 {
            font-size: 24px;
            color: #4b2c14;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #643f1a;
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
            text-align: left;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f7f5f2 !important;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .submit-container {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .btn-simpan {
            background-color: #d0aa91;
            color: #333;
            padding: 5px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-simpan:hover {
            background-color: #c77a36;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Hero -->
    <section class="hero-donasi-admin">
        <div class="hero-donasi-overlay">
            <div class="hero-donasi-text">
                <h1>Donasi Buku Perpustakaan</h1>
                <p><strong>Bersama Kita Tebarkan Ilmu Lewat Buku</strong><br>
                    Ayo berdonasi demi mendukung literasi masyarakat Kota Samarinda!
                </p>
            </div>
        </div>
    </section>

    <!-- Informasi -->
    <section class="donasi-info-box">
        <h3>Apa yang Bisa Didonasikan?</h3>
        <ul>
            <li>Buku pelajaran (SD, SMP, SMA)</li>
            <li>Buku anak-anak</li>
            <li>Novel dan fiksi</li>
            <li>Ensiklopedia, biografi, dan referensi</li>
            <li>Buku motivasi, keterampilan, ilmu umum</li>
        </ul>
        <p style="color: red;">❌ Tidak menerima buku rusak, bajakan, atau mengandung SARA/pornografi/kekerasan.</p>
        <div style="text-align: center; padding: 20px;">
            <strong style="color: #d97706;">Donasi Anda, Harapan Mereka</strong>
        </div>
    </section>

    <!-- Form Donasi -->
    <div class="form-container">
        <h2>📄 Form Tambahkan Buku</h2>
        <p>Isi form ini dengan lengkap sesuai dengan identitas buku yang akan didonasikan.</p>
        <form action="user_donasi.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Judul Buku*</label>
                <input type="text" name="judul_buku" required>
            </div>
            <div class="form-group">
                <label>Penulis*</label>
                <input type="text" name="penulis" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori*</label><br>
                <div class="checkbox-container">
                    <div>
                        <input type="checkbox" id="fiksi" name="kategori[]" value="fiksi">
                        <label for="fiksi">Fiksi</label>
                    </div>
                    <div>
                        <input type="checkbox" id="nonfiksi" name="kategori[]" value="nonfiksi">
                        <label for="nonfiksi">Non-Fiksi</label>
                    </div>
                    <div>
                        <input type="checkbox" id="pendidikan" name="kategori[]" value="pendidikan">
                        <label for="pendidikan">Pendidikan</label>
                    </div>
                    <div>
                        <input type="checkbox" id="anak" name="kategori[]" value="anak">
                        <label for="anak">Anak-anak</label>
                    </div>
                    <div>
                        <input type="checkbox" id="remaja" name="kategori[]" value="remaja">
                        <label for="remaja">Remaja</label>
                    </div>
                    <div>
                        <input type="checkbox" id="sejarah" name="kategori[]" value="sejarah">
                        <label for="sejarah">Sejarah</label>
                    </div>
                    <div>
                        <input type="checkbox" id="agama" name="kategori[]" value="agama">
                        <label for="agama">Agama</label>
                    </div>
                    <div>
                        <input type="checkbox" id="komik" name="kategori[]" value="komik">
                        <label for="komik">Komik</label>
                    </div>
                    <div>
                        <input type="checkbox" id="novel" name="kategori[]" value="novel">
                        <label for="novel">Novel</label>
                    </div>
                    <div>
                        <input type="checkbox" id="motivasi" name="kategori[]" value="Motivasi">
                        <label for="motivasi">Motivasi</label>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>Jumlah Buku*</label>
                <input type="number" name="jumlah_buku" min="1" required>
            </div>
            <div class="form-group">
                <label for="kondisi_buku">Kondisi Buku*</label>
                <select name="kondisi_buku" id="kondisi_buku" required>
                    <option value=""> </option>
                    <option value="baru">Baru</option>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Catatan Tambahan</label>
                <input type="text" name="catatan_tambahan">
            </div>
            <div class="form-group">
                <label for="foto">Upload Foto</label>
                <input type="file" name="foto" accept="image/*">
            </div>
            <div class="submit-container">
                <a href="index.php" class="keluar">Kembali</a>
                <button type="submit" class="btn-simpan">Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>