<?php
    require "session.php";
    require "../koneksi.php";

    $query = mysqli_query($con, "SELECT p.*, k.nama AS kategori_nama FROM produk p JOIN kategori k ON p.kategori_id = k.id");
    $jumlahProduk = mysqli_num_rows($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    function generateRandomString($length = 10) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <style>
        .no-decoration {
            text-decoration: none;
        }
        form div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../adminpanel/" class="text-muted no-decoration"><i class="fa-solid fa-house-chimney"></i> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>

        <!-- Tambah Produk -->
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Produk" required>
                </div>
                <div>
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <?php while ($data = mysqli_fetch_array($queryKategori)) { ?>
                            <option value="<?php echo $data["id"]; ?>"><?php echo $data["nama"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <div>
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail" class="form-label">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="3" class="form-control" placeholder="Masukkan Deskripsi Produk"></textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok" class="form-label">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-select">
                        <option value="tersedia">Tersedia</option>
                        <option value="tidak_tersedia">Tidak Tersedia</option>
                    </select>
                </div>
                <button class="btn btn-success mt-3" type="submit" name="tambah_produk">Tambah</button>
            </form>

            <?php
            if (isset($_POST["tambah_produk"])) {
                $nama = htmlspecialchars($_POST["nama"]);
                $kategori = htmlspecialchars($_POST["kategori"]);
                $harga = htmlspecialchars($_POST["harga"]);
                $detail = htmlspecialchars($_POST["detail"]);
                $ketersediaan_stok = htmlspecialchars($_POST["ketersediaan_stok"]);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $new_name = generateRandomString(25) . "." . $imageFileType;

                if ($nama_file != "") {
                    if ($image_size > 5000000 || !in_array($imageFileType, ["jpg", "png", "jpeg"])) {
                        echo '<div class="alert alert-danger mt-3">Foto tidak sesuai (ukuran > 5MB atau format salah)</div>';
                    } else {
                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                    }
                } else {
                    $new_name = null;
                }

                $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) 
                                                  VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

                if ($queryTambah) {
                    echo '<div class="alert alert-success mt-3">Produk Berhasil Ditambahkan</div>';
                    echo '<meta http-equiv="refresh" content="1; url=product.php">';
                } else {
                    echo mysqli_error($con);
                }
            }
            ?>
        </div>

        <!-- Tabel Produk -->
        <div class="mt-4 mb-5">
            <h2>List Produk</h2>
            <div class="table-responsive mt-3 mb-5">
                <table class="table table-bordered table-hover table-striped">
                    <thead >
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($jumlahProduk == 0) { ?>
                            <tr>
                                <td colspan="6" class="text-center">Data Produk Tidak Tersedia</td>
                            </tr>
                        <?php } else {
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($data["nama"]); ?></td>
                                    <td><?php echo htmlspecialchars($data["kategori_nama"]); ?></td>
                                    <td>Rp<?php echo number_format($data["harga"], 0, ',', '.'); ?></td>
                                    <td><?php echo ucfirst($data["ketersediaan_stok"]); ?></td>
                                    <td>
                                        <a href="product_detail.php?id=<?php echo $data["id"]; ?>" class="btn btn-info"><i class="fa-solid fa-circle-info"></i></a>
                                    </td>
                                </tr>
                            <?php 
                                     }
                                } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
