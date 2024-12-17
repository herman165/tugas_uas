<?php
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);


    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
  /* Desain Umum (untuk layar besar seperti PC dan laptop) */
.container {
    padding: 20px;
}

/* Kotak untuk kategori dan produk */
.kotak {
    border: solid;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
}

/* Menyesuaikan warna dan desain untuk kategori dan produk */
.summary-kategori {
    background-color: #0a6b4a;
    border-radius: 15px;
}

.summary-product {
    background-color: #0a516b;
    border-radius: 15px;
}

/* Mengatur tampilan link tanpa garis bawah */
.no-decoration {
    text-decoration: none;
}

/* Untuk breadcrumb */
.breadcrumb {
    font-size: 1.2rem;
}

/* Media Query untuk tablet dan perangkat dengan lebar layar lebih kecil dari 992px */
@media (max-width: 992px) {
    .kotak {
        padding: 15px;
    }

    .summary-kategori, .summary-product {
        border-radius: 10px;
    }

    .kotak .fa-5x {
        font-size: 3rem; /* Ukuran icon yang lebih kecil */
    }

    .kotak .fs-2 {
        font-size: 1.5rem; /* Ukuran teks lebih kecil */
    }

    .kotak p a {
        font-size: 1.1rem; /* Ukuran link sedikit lebih kecil */
    }

    h2 {
        font-size: 1.5rem; /* Ukuran judul lebih kecil */
    }

    /* Mengatur margin pada kontainer */
    .container {
        padding: 15px;
    }

    .breadcrumb {
        font-size: 1rem;
    }
}

/* Media Query untuk perangkat dengan lebar layar lebih kecil dari 768px (tablet ke bawah) */
@media (max-width: 768px) {
    /* Menyesuaikan ukuran gambar dan ikon */
    .kotak .fa-5x {
        font-size: 2.5rem; /* Ukuran icon lebih kecil */
    }

    .kotak {
        text-align: center;
        margin-bottom: 20px;
    }

    .kotak .fs-2 {
        font-size: 1.4rem;
    }

    h2 {
        font-size: 1.3rem;
    }

    .container {
        padding: 10px;
    }

    /* Mengubah tampilan breadcrumb menjadi lebih ringkas */
    .breadcrumb {
        font-size: 0.9rem;
    }

    .kotak p a {
        font-size: 1rem;
    }
}

/* Media Query untuk perangkat dengan lebar layar lebih kecil dari 576px (ponsel) */
@media (max-width: 576px) {
    .kotak {
        padding: 10px;
        margin-bottom: 10px;
    }

    .kotak .fa-5x {
        font-size: 2rem; /* Ukuran icon lebih kecil */
    }

    .kotak .fs-2 {
        font-size: 1.2rem;
    }

    .kotak p a {
        font-size: 1rem;
    }

    h2 {
        font-size: 1.2rem;
        text-align: center; /* Judul di tengah pada layar kecil */
    }

    .container {
        padding: 5px;
    }

    /* Mengubah breadcrumb menjadi lebih kecil dan lebih rapi */
    .breadcrumb {
        font-size: 0.8rem;
    }

    /* Membuat kotak kategori dan produk lebih mudah dibaca */
    .summary-kategori, .summary-product {
        padding: 10px;
    }
}

</style>
<body>
    <?php 
        require "navbar.php";
    ?>
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-solid fa-house-chimney"></i> Home
            </li>
        </ol>
    </nav>
    <h2>Hallo <?php echo $_SESSION["username"]; ?></h2>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-4 col-md-6 col12 mb-3 ">
                <div class=" kotak summary-kategori p-3 "> 
                    <div class="row">
                        <div class="col-5">
                            <i class="fa-solid fa-list fa-5x text-black-50"></i>
                        </div>
                        <div class="col-7 text-white">
                            <h3 class="fs-2">Kategori</h3>
                            <p class="fs-4"><?php echo $jumlahKategori; ?> kategori</p>
                            <p><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6  col-12 mb-3">
                <div class="kotak summary-product p-3"> 
                    <div class="row">
                        <div class="col-5">
                            <i class="fa-solid fa-box fa-5x text-black-50"></i>
                        </div>
                        <div class="col-7 text-white">
                            <h3 class="fs-2">Produk</h3>
                            <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
                            <p><a href="product.php" class="text-white no-decoration">Lihat Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



   <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>