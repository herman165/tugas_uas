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
 
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>