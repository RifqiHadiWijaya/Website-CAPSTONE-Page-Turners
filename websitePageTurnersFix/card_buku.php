<?php
if (!isset($buku)) return;
$is_favorit = in_array($buku["id_buku"], $_SESSION['favorit']) ? '❤️' : '🤍';
?>

<div class="card-buku">
    <a href="detail_buku.php?id=<?= urlencode($buku["id_buku"]) ?>" class="card-link">
        <img src="img/<?= htmlspecialchars($buku["foto"]) ?>" alt="Gambar Buku">
        <p><?= htmlspecialchars($buku["judul"]) ?></p>
    </a>
    <form method="post" action="" class="form-favorit">
        <input type="hidden" name="favorit_id" value="<?= $buku["id_buku"] ?>">
        <button type="submit" name="tambah_favorit" class="btn-favorit"><?= $is_favorit ?></button>
    </form>
</div>