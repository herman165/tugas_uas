<?php
    require "koneksi.php";



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
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
    <h2>Keranjang Belanja</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Pengguna</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Tanggal Ditambahkan</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['nama_produk'] . "</td>
                    <td>" . $row['jumlah'] . "</td>
                    <td>" . $row['tanggal_ditambahkan'] . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Keranjang kosong</td></tr>";
        }
        ?>
    </table>
</body>

</html>