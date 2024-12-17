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
       <div class="container text-center text-white py-5">
            <h1 class="mt-4">Selamat Datang di Toko Online Fashion</h1>
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
        <div class="container text-center ">
            <h3>Kategori Terlaris</h3>
            <div class="row mt-5">
                <div class="col-md-3 py-3">
                    <div class="highlighted-kategori kategori-baju-pria d-flex justify-content-center align-items-center">
                        <h4 ><a class="  no-decoration"  href="produk.php?kategori=Baju Pria">Baju Pria</a></h4>
                    </div>
                </div>
                <div class="col-md-3 py-3">
                    <div class="highlighted-kategori kategori-baju-wanita d-flex justify-content-center align-items-center">
                         <h4><a class=" no-decoration " href="produk.php?kategori=Baju Wanita">Baju wanita</a></h4>
                    </div>
                </div>
                <div class="col-md-3 py-3 ">
                    <div class="highlighted-kategori kategori-sepatu-pria d-flex justify-content-center align-items-center">
                       <h4><a class=" no-decoration " href="produk.php?kategori=Sepatu Pria" >Sepatu Pria</a></h4>
                    </div>
                </div>
                <div class="col-md-3 py-3 ">
                    <div class="highlighted-kategori kategori-jam-pria d-flex justify-content-center align-items-center">
                         <h4><a class=" no-decoration" href="produk.php?kategori=Jam Pria">Jam Pria</a></h4>
                    </div>
                </div>
            </div>
        </div>
     </div>

     <!-- tentang kami -->
      <div class="container-fluid warna1 py-5 ">
        <div class="container text-center text-white">
           <h3>Tentang Kami</h3>
                <p class="fs-5 mt-3">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores aspernatur excepturi velit! Minima accusamus illum atque laudantium odio dolores provident, excepturi maiores quis facilis nemo reprehenderit iure mollitia tenetur veritatis accusantium voluptatem, animi quidem enim non officiis quia. Ex totam aut aliquam doloribus sint aspernatur modi reiciendis ut rem iusto facere magni, repudiandae quaerat? Labore, dolorum! Necessitatibus, eligendi aperiam id architecto facilis quia illum odit alias nihil ad velit ab esse quam voluptatem optio. Vel aspernatur alias eos iure porro.
                </p>
        </div>
      </div>

      <!-- produk -->
      <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk </h3>

            <div class="row mt-5">
               <div class="col-md-3 py-3">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
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
