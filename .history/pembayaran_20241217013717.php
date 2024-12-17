<?php
require "koneksi.php"; // Koneksi ke database

// Ambil data pembayaran dari database
$query = "SELECT p.id, u.username, p.total_harga, p.metode_pembayaran, p.status_pembayaran, p.tanggal_pembayaran 
          FROM pembayaran p
          JOIN users u ON p.user_id = u.id";
          



// Cek apakah ada perubahan status pembayaran
if (isset($_GET['confirm']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['confirm'];

    // Update status pembayaran
    $update_query = "UPDATE pembayaran SET status_pembayaran = ? WHERE id = ?";
    if ($stmt = $koneksi->prepare($update_query)) {
        $stmt->bind_param('si', $status, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Status pembayaran berhasil diperbarui.'); window.location='pembayaran.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui status pembayaran.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Query gagal.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Data Pembayaran</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Total Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
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
                            <td>
                                <a href='?confirm=selesai&id=" . $row['id'] . "' class='btn btn-success'>Konfirmasi Selesai</a>
                                <a href='?confirm=gagal&id=" . $row['id'] . "' class='btn btn-danger'>Konfirmasi Gagal</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Belum ada data pembayaran</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>