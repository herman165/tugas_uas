<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "toko_online");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
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
    </style>
</head>

<body>
    <h2>Data Pembayaran</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Pengguna</th>
            <th>Total Harga</th>
            <th>Metode Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Tanggal Pembayaran</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>Rp " . number_format($row['total_harga'], 2, ',', '.') . "</td>
                    <td>" . $row['metode_pembayaran'] . "</td>
                    <td>" . ucfirst($row['status_pembayaran']) . "</td>
                    <td>" . $row['tanggal_pembayaran'] . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Belum ada data pembayaran</td></tr>";
        }
        ?>
    </table>
</body>

</html>