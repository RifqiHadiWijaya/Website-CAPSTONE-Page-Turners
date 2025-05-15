<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Buku</title>
  <!-- Font Awesome (opsional, untuk ikon upload) -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      margin: 0;
      background-color: #f7f2eb;
    }

    .logo img {
      height: 50px;
      width: auto;
    }

    .navbar {
      background-color: #f4c09d;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
    }

    .top-bar img {
      height: 60px;
      margin-right: 10px;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
      margin: 0;
      padding: 0;
    }

    .nav-links li a {
      text-decoration: none;
      color: #000;
      font-weight: bold;
    }

    .nav-links li a.active,
    .nav-links li a:hover {
      background-color: #d77e2d;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .hero {
      position: relative;
    }

    .hero img {
      width: 100%;
      height: 600px;
      object-fit: cover;
      filter: brightness(0.6);
    }

    .tabs {
      position: absolute;
      bottom: 50px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      justify-content: center;
      gap: 20px;
      z-index: 2;
    }

    .tabs button {
      background: #f6e9df;
      border: none;
      padding: 10px 25px;
      margin: 0 10px;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      border-radius: 8px;
      margin-top: 30px;
      margin-bottom: 30px;
    }

    .tabs a {
      text-decoration: none;
    }

    .tabs button:hover {
      background-color: #e0d2c0;
      transition: background-color 0.3s ease;
    }

    .hero-text {
      position: absolute;
      top: 35%;
      left: 60%;
      transform: translateY(-50%);
      color: #fff;
      width: 500px;
      height: 200px;
      padding: 20px;
      word-spacing: 5px;
      line-height: 25px;
    }

    .hero-text h2 {
      font-size: 28px;
      margin: 0;
      color: #efaa71;
      text-align: left;
    }

    .hero-text h3 {
      font-size: 20px;
      margin: 10px 0;
      color: #edd1ba;
    }

    .hero-text p {
      font-size: 18px;
      line-height: 1.5;
      margin: 0;
    }
  </style>
</head>

<body>

  <header>
    <?php include 'navbar_admin.php'; ?>
  </header>

  <div class="hero">
    <img src="img/donasi.jpg" alt="Hero Image" />
    <div class="hero-text">
      <h2>Konten Perpustakaan</h2>
      <h3>Bersama Kita Kembangkan Ilmu dan Akses Pengetahuan</h3>
      <p>
        Perpustakaan Kota Samarinda menyediakan berbagai konten edukatif yang dapat dikelola dan dibagikan kepada masyarakat.
        Mari turut berkontribusi dalam memperkaya koleksi buku, artikel, dan informasi fasilitas guna mendukung literasi dan layanan perpustakaan yang inklusif.
      </p>
    </div>
    <div class="tabs">
      <a href="kontenbuku_admin.php"><button>📚 Buku</button></a>
      <a href="kontenartikel_admin.php"><button>📄 Artikel</button></a>
      <a href="kontenfasilitas_admin.php"><button>🏢 Fasilitas</button></a>
    </div>
  </div>

</body>

</html>