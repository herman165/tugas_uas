<?php 
    require "koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    
    // get product by search
        if(isset($_GET["search"])){
            $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[search]%'");            
        }
    // get product by kategori
        else if(isset($_GET["kategori"])){
            $queryGetKategori = mysqli_query($con, "SELECT id FROM kategori WHERE nama = '$_GET[kategori]'");
            $KategoriId = mysqli_fetch_array($queryGetKategori);

            $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id = '$KategoriId[id]'");
        }
    // get product default
        else{
            $queryProduk = mysqli_query($con, "SELECT * FROM produk");
        }

   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk-Page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- navbar -->
    <?php require "navbar.php" ?>

    <!-- benner -->
     <div class="container-fluid banner d-flex align-items-center">
        <div class="container">
            <h1 class="mt-4 text-white text-center">Produk</h1>
        </div>
     </div>

    <!-- layout produk -->
        <div class="container py-5">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h4 class="mb-3">Kategori</h4>
                    <ul class="list-group">
                        <?php while($kategori = mysqli_fetch_array($queryKategori)){?>
                           <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori["nama"]; ?>"> 
                             <li class="list-group-item"><?php echo $kategori["nama"]; ?></li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>
                
                <div class="col-md-6">
                    <h3 class="text-center mb-4">Product</h3>
                    <div class="row">
                        <?php while($produk = mysqli_ferch) ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="image-box">
                                        <img src="image/" class="card-img-top" alt="...">
                                    </div>     
                                    <div class="card-body">
                                        <h5 class="card-title">dsdsd</h5>
                                        <p class="card-text text-truncate">dsdsdsd</p>
                                        <p class="card-text text-harga">222323</p>
                                        <a href="produk_detail.php?nama=fefsed" class="btn-btn warna3 no-decoration text-white">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div> 


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>