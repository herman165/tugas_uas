<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
   
<style>
  
        /* Khusus tampilan HP */
        @media (max-width: 480px) {
            .navbar {
                background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient ungu ke biru */
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); /* Bayangan */
                border-radius: 5px; /* Membuat sudut melengkung */
            }

            .navbar-dark .nav-link {
                color: #ffffff;
                background-color: rgba(255, 255, 255, 0.2); /* Transparan putih */
                margin: 5px;
                padding: 10px;
                border-radius: 5px; /* Melengkung */
                text-align: center;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            .navbar-dark .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.4); /* Lebih terang saat hover */
                color: #ffcc00; /* Warna kuning keemasan */
            }

            /* Tombol toggler */
            .navbar-dark .navbar-toggler {
                border: none;
                background-color: #ffffff; /* Putih */
                padding: 5px;
                border-radius: 3px; /* Melengkung */
            }

            .navbar-dark .navbar-toggler-icon {
                background-color: #6a11cb; /* Ungu */
                border-radius: 2px;
                width: 25px;
                height: 3px;
            }
        }
    
</style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark warna1">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4 ">
                        <a class="nav-link " href="../adminpanel/">Home</a>
                    </li>
                    <li class="nav-item me-4 ">
                        <a class="nav-link" href="tentang.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item me-4 ">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
