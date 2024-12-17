<?php
Mulai sesi untuk mengambil data keranjang
require "koneksi.php";

// Menghitung total harga dan menangani penghapusan produk dari keranjang
$totalHarga = 0;

// Periksa jika keranjang ada isinya
if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
    // Ambil ID produk yang ada di keranjang
    $produk_ids = array_keys($_SESSION['keranjang']);
    // Hanya jalankan query jika produk_ids tidak kosong
    if (!empty($produk_ids)) {
        // Ambil data produk berdasarkan ID yang ada di keranjang
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE id IN (" . implode(',', $produk_ids) . ")");
    } else {
        $queryProduk = null; // Jika tidak ada ID produk, set queryProduk menjadi null
    }
} else {
    $queryProduk = null; // Jika keranjang kosong, set queryProduk menjadi null
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
    <style>
        /* Menambahkan padding dan margin pada elemen untuk responsivitas */
        .card {
            margin-bottom: 15px;
        }

        .card-body {
            padding: 15px;
        }

        @media (max-width: 767px) {
            .card-img-top {
                height: 200px;
                object-fit: cover;
            }
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <?php require "navbar.php" ?>

    <!-- Keranjang -->
    <div class="container py-5">
        <h3 class="text-center mb-4">Keranjang Belanja</h3>
        <div class="row">
            <?php
            if ($queryProduk && mysqli_num_rows($queryProduk) > 0) {
                while ($produk = mysqli_fetch_array($queryProduk)) {
                    $produk_id = $produk['id'];
                    $jumlah = $_SESSION['keranjang'][$produk_id];
                    $totalHarga += $produk['harga'] * $jumlah;
                    ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100">
                            <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                                <p class="card-text"><?php echo $produk['detail']; ?></p>
                                <p class="card-text">Jumlah: <?php echo $jumlah; ?></p>
                                <p class="card-text">Harga: Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                <a href="keranjang.php?remove=<?php echo $produk_id; ?>" class="btn btn-danger">Hapus</a>
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

        <!-- Menampilkan Total Harga -->
        <?php if (isset($totalHarga) && $totalHarga > 0) { ?>
            <div class="text-right mt-4">
                <h4>Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></h4>
            </div>
        <?php } ?>

        <!-- Tombol Checkout -->
        <?php if ($totalHarga > 0) { ?>
            <div class="text-right mt-4">
                <a href="checkout.php" class="btn btn-primary">Checkout</a>
            </div>
        <?php } ?>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>