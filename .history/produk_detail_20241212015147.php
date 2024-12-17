<?php 
    require "koneksi.php";

    $nama = mysqli_real_escape_string ($con, $_GET["nama"]);

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
                    <img src="image/baju pria.jpg" alt="" class="w-100"> 
                </div>
                <div class="col-md-6 offset-md-1">
                    <h1>Kemaja</h1>
                    <p class="fs-6">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Error at facilis ipsum quaerat nihil, necessitatibus amet impedit, praesentium tempore molestiae doloremque fugit facere dolorum suscipit? Maxime illum ratione aspernatur, cum reprehenderit dicta recusandae omnis consectetur eaque, doloribus suscipit itaque praesentium amet facere reiciendis, repellat voluptates accusantium? Perspiciatis aperiam impedit error sed. Exercitationem, saepe. Odio hic sit ducimus porro quo? Hic, sequi quam facilis libero aut necessitatibus impedit magnam cumque repudiandae, deserunt, expedita dolore rerum tempora pariatur distinctio consectetur quasi ea! Accusamus exercitationem nihil cupiditate iste vitae, inventore soluta corporis. Sapiente nam natus quam fugiat accusamus deserunt recusandae pariatur asperiores debitis.
                    </p>
                    <p class="text-harga">
                        Rp 100000
                    </p>
                    <p class="fs-6">Status Ketersediaan : <strong>tersedia</strong></p>
                </div>    
            </div>
        </div> 
    </div>


     <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>