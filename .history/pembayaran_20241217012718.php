<?php
require "koneksi.php"; // Pastikan file koneksi benar

// Proses Tambah Pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_payment'])) {
    $user_id = $_POST['user_id'];
    $total_harga = $_POST['total_harga'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Query untuk menambahkan data ke tabel pembayaran
    $query = "INSERT INTO pembayaran (user_id, total_harga, metode_pembayaran) 
              VALUES ('$user_id', '$total_harga', '$metode_pembayaran')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: pembayaran.php?status=success");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

// Proses Update Status Pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status_pembayaran = $_POST['status_pembayaran'];

    $query = "UPDATE pembayaran SET status_pembayaran = '$status_pembayaran' WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: pembayaran.php?status=updated");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
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

    <div class="container mt-4">
        <h1 class="mb-4">Halaman Pembayaran</h1>

        <!-- Form untuk menambahkan pembayaran -->
        <div class="card mb-4">
            <div class="card-header">Tambah Pembayaran</div>
            <div class="card-body">
                <form action="pembayaran.php" method="POST">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">ID Pengguna</label>
                        <input type="number" name="user_id" id="user_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_harga" class="form-label">Total Harga</label>
                        <input type="number" step="0.01" name="total_harga" id="total_harga" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="Kartu Kredit">Kartu Kredit</option>
                        </select>
                    </div>
                    <button type="submit" name="add_payment" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>

        <!-- Tabel untuk menampilkan data pembayaran -->
        <div class="card">
            <div class="card-header">Daftar Pembayaran</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Pengguna</th>
                            <th>Total Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM pembayaran";
                        $result = mysqli_query($koneksi, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['user_id']}</td>
                                <td>Rp " . number_format($row['total_harga'], 2, ',', '.') . "</td>
                                <td>{$row['metode_pembayaran']}</td>
                                <td>{$row['status_pembayaran']}</td>
                                <td>{$row['tanggal_pembayaran']}</td>
                                <td>
                                    <form action='pembayaran.php' method='POST' class='d-inline'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <select name='status_pembayaran' class='form-select mb-2'>
                                            <option value='pending' " . ($row['status_pembayaran'] === 'pending' ? 'selected' : '') . ">Pending</option>
                                            <option value='selesai' " . ($row['status_pembayaran'] === 'selesai' ? 'selected' : '') . ">Selesai</option>
                                            <option value='gagal' " . ($row['status_pembayaran'] === 'gagal' ? 'selected' : '') . ">Gagal</option>
                                        </select>
                                        <button type='submit' name='update_status' class='btn btn-warning btn-sm'>Update</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>