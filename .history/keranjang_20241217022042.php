<?php
session_start();
require "koneksi.php";

// Tambahkan produk ke keranjang
if (isset($_GET['add_to_cart'])) {
    $id_produk = $_GET['add_to_cart'];

    // Periksa apakah produk sudah ada di keranjang
    if (isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk] += 1; // Tambahkan jumlah produk
    } else {
        $_SESSION['keranjang'][$id_produk] = 1; // Tambahkan produk baru ke keranjang
    }

    // Redirect ke halaman keranjang untuk menghindari refresh ulang
    header('Location: keranjang.php');
    exit();
}

// Hapus produk dari keranjang
if (isset($_GET['remove'])) {
    $id_produk = $_GET['remove'];

    if (isset($_SESSION['keranjang'][$id_produk])) {
        unset($_SESSION['keranjang'][$id_produk]); // Hapus produk dari keranjang
    }

    header('Location: keranjang.php');
    exit();
}

// Cek apakah keranjang kosong
if (empty($_SESSION['keranjang'])) {
    // Jika keranjang kosong, redirect ke halaman produk
    header('Location: produk.php');
    exit();
}

// Ambil data produk yang ada di keranjang
$produk_ids = isset($_SESSION['keranjang']) ? array_keys($_SESSION['keranjang']) : [];
$queryProduk = !empty($produk_ids)
    ? mysqli_query($con, "SELECT * FROM produk WHERE id IN (" . implode(',', $produk_ids) . ")")
    : false;

// Inisialisasi total harga
$totalHarga = 0;
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
    <!-- Navbar -->
   <?php

    <!-- Keranjang -->
    <div class="container py-5">
        <h3 class="text-center mb-4">Keranjang Belanja</h3>
        <div class="row">
            <?php if ($queryProduk && mysqli_num_rows($queryProduk) > 0): ?>
                <?php while ($produk = mysqli_fetch_array($queryProduk)): ?>
                    <?php
                    $id_produk = $produk['id'];
                    $jumlah = $_SESSION['keranjang'][$id_produk];
                    $subtotal = $produk['harga'] * $jumlah;
                    $totalHarga += $subtotal;
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $produk['nama']; ?>
                                </h5>
                                <p class="card-text">Jumlah:
                                    <?php echo $jumlah; ?>
                                </p>
                                <p class="card-text">Subtotal: Rp
                                    <?php echo number_format($subtotal, 0, ',', '.'); ?>
                                </p>
                                <a href="keranjang.php?remove=<?php echo $id_produk; ?>" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">Keranjang Anda kosong.</p>
            <?php endif; ?>
        </div>

        <?php if ($totalHarga > 0): ?>
            <div class="text-center">
                <h4>Total Harga: Rp
                    <?php echo number_format($totalHarga, 0, ',', '.'); ?>
                </h4>
                <!-- Tombol Pembayaran -->
                <a href="pembayaran.php" class="btn btn-success mt-3">Bayar Sekarang</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>