<?php 
    require "koneksi.php";

    $nama = htmlspecialchars ( $_GET["nama"]);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama = '$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id = '$produk[kategori_id]' AND nama != '$produk[nama]' LIMIT 4");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- detail-produk -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="image/<?php echo $produk["foto"]; ?>" alt="" class="w-100"> 
                </div>
                <div class="col-md-6 offset-lg-1">
                    <h1><?php echo $produk["nama"]; ?></h1>
                    <p class="fs-6">
                        <?php echo $produk["detail"]; ?>
                    </p>
                    <p class="text-harga">
                        Rp <?php echo number_format($produk["harga"], 0, ',', '.'); ?>
                    </p>
                    <p class="fs-6">Status Ketersediaan : <strong><?php echo $produk["ketersediaan_stok"]; ?></strong></p>
                </div>    
            </div>
        </div> 
    </div>

    <!-- product- terkait-->
    <div class="container py-5 warna2">
        <div class="container">
            <h3 class="text-center text-white py-4">Produk Terkait</h3>

            <div class="row">
                <?php while($data = mysqli_fetch_array($queryProdukTerkait)){?>
                <div class="col-md-2 col-lg-2 mb-3">
                    <a href="produk_detail.php?nama=<?php echo $data["nama"]; ?>">
                        <img src="image/<?php echo $data["foto"]; ?>" class="img-fluid img-thumbnail produk-terkait-image"  alt="">
                    </a>
                    
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
                    
    <!-- footer -->
     <?php require "footer.php" ?>
     
     <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>