<?php
session_start();
require "koneksi.php";

// Periksa apakah keranjang kosong
if (empty($_SESSION['keranjang'])) {
    header('Location: produk.php');
    exit();
}

// Ambil data produk dari keranjang
$produk_ids = isset($_SESSION['keranjang']) ? array_keys($_SESSION['keranjang']) : [];
$queryProduk = !empty($produk_ids)
    ? mysqli_query($con, "SELECT * FROM produk WHERE id IN (" . implode(',', $produk_ids) . ")")
    : false;

// Inisialisasi total harga
$totalHarga = 0;
$produkList = [];

// Hitung total harga dan buat array untuk produk yang ada di keranjang
if ($queryProduk && mysqli_num_rows($queryProduk) > 0) {
    while ($produk = mysqli_fetch_array($queryProduk)) {
        $id_produk = $produk['id'];
        $jumlah = $_SESSION['keranjang'][$id_produk];
        $subtotal = $produk['harga'] * $jumlah;
        $totalHarga += $subtotal;
        $produkList[] = $produk;
    }
}

// Proses pembayaran
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];  // Pastikan user_id ada dalam session
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $status_pembayaran = 'pending';  // Default status pembayarannya adalah pending

    // Insert data pembayaran ke tabel pembayaran
    $queryInsert = "INSERT INTO pembayaran (user_id, total_harga, metode_pembayaran, status_pembayaran) 
                    VALUES ('$user_id', '$totalHarga', '$metode_pembayaran', '$status_pembayaran')";

    if (mysqli_query($con, $queryInsert)) {
        // Menghapus keranjang setelah pembayaran berhasil
        unset($_SESSION['keranjang']);

        // Set notifikasi sukses
        $_SESSION['message'] = "Pembayaran berhasil! Pembayaran Anda sedang diproses.";

        // Redirect ke halaman produk
        header('Location: produk.php');
        exit();
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <div class="container py-5">
        <h3 class="text-center mb-4">Detail Pembayaran</h3>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info text-center">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($produkList as $produk): ?>
                <?php
                $id_produk = $produk['id'];
                $jumlah = $_SESSION['keranjang'][$id_produk];
                $subtotal = $produk['harga'] * $jumlah;
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                            <p class="card-text">Jumlah: <?php echo $jumlah; ?></p>
                            <p class="card-text">Subtotal: Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center">
            <h4>Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></h4>
        </div>

        <form action="pembayaran.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                    <option value="transfer">Transfer Bank</option>
                    <option value="kartu_kredit">Kartu Kredit</option>
                    <option value="gopay">GoPay</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Bayar Sekarang</button>
        </form>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>