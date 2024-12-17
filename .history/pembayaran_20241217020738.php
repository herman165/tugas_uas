<?php
session_start();
require "koneksi.php";

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "toko_online");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah ada parameter 'keranjang' di URL dan apakah session_id yang dikirimkan sama dengan session yang aktif
if (isset($_GET['keranjang']) && $_GET['keranjang'] === session_id()) {
    // Ambil data produk dari keranjang
    if (empty($_SESSION['keranjang'])) {
        echo "Keranjang Anda kosong.";
        exit();
    }

    $produk_ids = array_keys($_SESSION['keranjang']);
    $queryProduk = "SELECT * FROM produk WHERE id IN (" . implode(',', $produk_ids) . ")";
    $queryResult = $koneksi->query($queryProduk);

    // Hitung total harga
    $totalHarga = 0;
    while ($produk = $queryResult->fetch_assoc()) {
        $id_produk = $produk['id'];
        $jumlah = $_SESSION['keranjang'][$id_produk];
        $subtotal = $produk['harga'] * $jumlah;
        $totalHarga += $subtotal;
    }
}

// Jika ada parameter 'id' dalam query string, kita proses pembayaran
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update status pembayaran menjadi "Lunas"
    $updateQuery = "UPDATE pembayaran SET status_pembayaran = 'Lunas' WHERE id = $id";
    if ($koneksi->query($updateQuery)) {
        echo "<script>alert('Pembayaran berhasil dilakukan!'); window.location.href='pembayaran.php';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}

// Ambil data pembayaran
$query = "SELECT p.id, u.username, p.total_harga, p.metode_pembayaran, p.status_pembayaran, p.tanggal_pembayaran 
          FROM pembayaran p
          JOIN users u ON p.user_id = u.id";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .btn-bayar {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-bayar:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h2>Data Pembayaran</h2>

    <!-- Tampilkan Data Keranjang -->
    <?php if (isset($totalHarga)): ?>
        <h3>Total Harga Keranjang: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></h3>
        <a href="pembayaran.php?keranjang=<?php echo session_id(); ?>" class="btn btn-success mt-3">Proses Pembayaran</a>
    <?php endif; ?>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pengguna</th>
            <th>Total Harga</th>
            <th>Metode Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Tanggal Pembayaran</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . htmlspecialchars($row['username']) . "</td>
                    <td>Rp " . number_format($row['total_harga'], 2, ',', '.') . "</td>
                    <td>" . htmlspecialchars($row['metode_pembayaran']) . "</td>
                    <td>" . ucfirst(htmlspecialchars($row['status_pembayaran'])) . "</td>
                    <td>" . $row['tanggal_pembayaran'] . "</td>
                    <td>";

                // Jika status pembayaran belum lunas, tampilkan tombol bayar
                if ($row['status_pembayaran'] != 'Lunas') {
                    echo "<a href='pembayaran.php?id=" . $row['id'] . "' class='btn-bayar'>Bayar Sekarang</a>";
                } else {
                    echo "Lunas";
                }

                echo "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Belum ada data pembayaran</td></tr>";
        }
        ?>
    </table>
</body>

</html>