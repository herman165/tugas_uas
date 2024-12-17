<?php
require "koneksi.php";

// Ambil data pembayaran dari database
$query = "SELECT p.id, p.total_harga, p.metode_pembayaran, p.status_pembayaran, p.tanggal_pembayaran, u.nama 
              FROM pembayaran p
              JOIN users u ON p.user_id = u.id";
$result = mysqli_query($conn, $query);

// Proses form pembayaran baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $total_harga = $_POST['total_harga'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $status_pembayaran = $_POST['status_pembayaran'];

    $insertQuery = "INSERT INTO pembayaran (user_id, total_harga, metode_pembayaran, status_pembayaran) 
                        VALUES ('$user_id', '$total_harga', '$metode_pembayaran', '$status_pembayaran')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "<div class='alert alert-success'>Pembayaran berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
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

    <?php require "navbar.php" ?>

    <div class="container mt-5">
        <h2>Data Pembayaran</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pembayaran</th>
                    <th>Nama User</th>
                    <th>Total Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo number_format($row['total_harga'], 2, ',', '.'); ?></td>
                        <td><?php echo $row['metode_pembayaran']; ?></td>
                        <td><?php echo $row['status_pembayaran']; ?></td>
                        <td><?php echo date('d-m-Y H:i', strtotime($row['tanggal_pembayaran'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Tambah Pembayaran Baru</h3>
        <form action="pembayaran.php" method="POST">
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <?php
                    // Ambil data user untuk dropdown
                    $userQuery = "SELECT * FROM users";
                    $userResult = mysqli_query($conn, $userQuery);
                    while ($user = mysqli_fetch_assoc($userResult)) {
                        echo "<option value='" . $user['id'] . "'>" . $user['nama'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" step="0.01" class="form-control" name="total_harga" id="total_harga" required>
            </div>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                    <option value="transfer">Transfer</option>
                    <option value="kartu kredit">Kartu Kredit</option>
                    <option value="gopay">GoPay</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="selesai">Selesai</option>
                    <option value="gagal">Gagal</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pembayaran</button>
        </form>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>