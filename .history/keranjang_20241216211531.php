<?php
session_start(); // Mulai sesi untuk mengambil data keranjang
require "koneksi.php";

// Ambil produk yang ada di keranjang
if (isset($_SESSION['keranjang'])) {
    $produk_ids = array_keys($_SESSION['keranjang']);
    // Ambil data produk berdasarkan ID yang ada di keranjang
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE id IN (" . implode(',', $produk_ids) . ")");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body>
    <!-- navbar -->
    <?php require "navbar.php" ?>

    <!-- Keranjang -->
    <div class="container py-5">
        <h3 class="text-center mb-4">Keranjang Belanja</h3>
        <div class="row">
            <?php
            if (isset($queryProduk) && mysqli_num_rows($queryProduk) > 0) {
                while ($produk = mysqli_fetch_array($queryProduk)) {
                    $produk_id = $produk['id'];
                    $jumlah = $_SESSION['keranjang'][$produk_id];
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                                <p class="card-text"><?php echo $produk['detail']; ?></p>
                                <p class="card-text">Jumlah: <?php echo $jumlah; ?></p>
                                <p class="card-text">Harga: Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>Keranjang Anda kosong.</p>';
            }
            ?>
        </div>
    </div>

    <!-- footer -->
<?php require "footer.php" ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>