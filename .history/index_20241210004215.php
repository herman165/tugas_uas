<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
   
</head>
<body>
    <!-- Navbar -->
    <?php require "navbar.php"; ?>
    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
       <div class="container text-center text-white">
            <h1>Selamat Datang di Toko Online Fashion</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-md-6 mx-auto offset-md-3">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg mb-3 my-4">
                        <input type="text" class="form-control" placeholder="Cari Produk" aria-label="Cari Produk" aria-describedby="button-addon2" name="keyword">
                        <button type="submit" class="btn-btn warna2 text-white" type="button" id="button-addon2">Telusuri</button>
                    </div>
                </form> 
            </div>
       </div>
    </div>
    <!-- Kategori -->
     <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>
            <div class="row mt-5">
                <div class="col-md-3 py-3">
                    <div class="highlighted-kategori kategori-baju-pria d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a href="produk.php?kategori=Baju pria" class="text-white no-decoration">Baju Pria</a></h4>
                    </div>
                </div>
                <div class="col-md-3 py-3">
                    <div class="highlighted-kategori kategori-baju-wanita d-flex justify-content-center align-items-center">
                         <h4 class="text-white"><a href="produk.php?kategori=Baju Wanita" class="text-white no-decoration">Baju wanita</a></h4>
                    </div>
                </div>
                <div class="col-md-3 py-3 ">
                    <div class="highlighted-kategori kategori-sepatu-pria d-flex justify-content-center align-items-center">
                       <h4 class="text-white"><a href="produk.php?kategori=Sepatu_Pria" class="text-white no-decoration">Sepatu Pria</a></h4>
                    </div>
                </div>
                <div class="col-md-3 py-3 ">
                    <div class="highlighted-kategori kategori-jam-pria d-flex justify-content-center align-items-center">
                         <h4 class="text-white"><a href="produk.php?kategori=Jam Pria" class="text-white no-decoration">Jam Pria</a></h4>
                    </div>
                </div>
            </div>
        </div>
     </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
