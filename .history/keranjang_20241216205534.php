<?php 
require "koneksi.php"; 

// Query untuk mengambil data dari tabel keranjang dan produk
$queryKeranjang = mysqli_query($con, 
    "SELECT keranjang.id, produk.nama, produk.harga, keranjang.jumlah, produk.foto 
    FROM keranjang 
    JOIN produk ON keranjang.produk_id = produk.id"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .table thead th {
            background-color: #ff5722; /* Warna oranye khas */
            color: white;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .total-section {
            background-color: #ff5722;
            color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .checkout-btn {
            background-color: #ff5722;
            color: white;
            font-weight: bold;
        }
        .checkout-btn:hover {
            background-color: #e64a19;
            color: white;
        }
        .product-img {
            max-width: 80px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .remove-btn {
            color: red;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- Container Keranjang -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Keranjang Belanja</h3>

        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $totalBayar = 0;
                    while($keranjang = mysqli_fetch_array($queryKeranjang)) {
                        $totalHarga = $keranjang['harga'] * $keranjang['jumlah'];
                        $totalBayar += $totalHarga;
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <img src="image/<?php echo $keranjang['foto']; ?>" class="product-img">
                        </td>
                        <td><?php echo $keranjang['nama']; ?></td>
                        <td>Rp <?php echo number_format($keranjang['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <input type="number" value="<?php echo $keranjang['jumlah']; ?>" min="1" class="form-control w-50 mx-auto">
                        </td>
                        <td>Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></td>
                        <td>
                            <a href="hapus_keranjang.php?id=<?php echo $keranjang['id']; ?>" class="remove-btn" onclick="return confirm('Hapus produk ini?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Section Total Bayar -->
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="total-section text-center">
                    <h5>Total Bayar</h5>
                    <h3>Rp <?php echo number_format($totalBayar, 0, ',', '.'); ?></h3>
                    <a href="checkout.php" class="btn checkout-btn mt-3 w-100">
                        <i class="fa-solid fa-cart-arrow-down"></i> Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
