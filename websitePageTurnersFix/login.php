<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Masuk</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="login-page">

    <header>
        <nav class="navbarr">
            <div class="logoatas">
                <img src="https://perpustakaankearsipan.samarindakota.go.id/storage/Template/logo.png" alt="Logo">
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="left">
            <h2 style="margin-top: 35px; margin-bottom: 35px;">Masuk</h2>
            <form action="login_process.php" method="post">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" required />

                <label for="password">Kata Sandi <span class="required">*</span></label>
                <input type="password" id="password" name="password" required />

                <button type="submit" style="margin-left: 140px; margin-top: 50px;">Mulai</button>
            </form>
            <div class="register">
                Belum punya akun? <a href="register.php">Daftar di sini</a>
            </div>
        </div>
    </div>
</body>

</html>