<?php
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori-page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    /* Mengatur tampilan link tanpa garis bawah */
.no-decoration {
    text-decoration: none;
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
                    <a href="../adminpanel/" class="text-muted no-decoration">
                    <i class="fa-solid fa-house-chimney"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                     Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Katergori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukkan Kategori">
                </div>
                <div>
                    <button class="btn btn-success  mt-3" type="submit" name="tambah_Kategori">Tambah</button>
                </div>
            </form>
            <?php 
                if(isset($_POST["tambah_Kategori"])){
                    $kategori = htmlspecialchars($_POST["kategori"]);

                    $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama = '$kategori'");

                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                    if($jumlahDataKategoriBaru > 0){
                        ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                Kategori Sudah Ada
                            </div>
                        <?php
                    }
                    else{
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                        if($querySimpan){
                            ?>
                                <div class="alert alert-success mt-3" role="alert"> 
                                    Kategori Berhasil Ditambahkan
                                </div>
                                
                                <meta http-equiv="refresh" content="1; url=kategori.php">
                            <?php
                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }

                }
            ?>
        </div>

        <div class="mt-4">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5 " colspan="3">
                <table class="table" >
                    <thead>
                        <tr>
                            <th colspan="3">No</th>
                            <th colspan="3">Nama</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                            if($jumlahKategori == 0){
                        ?>
                            <tr>
                                <td colspan="3" class="text-center">Data Katergori Tidak Tersedia</td>
                            </tr>
                        <?php        
                            }
                            else{
                                $jumlah=1;
                                while($data = mysqli_fetch_array($queryKategori)){
                        ?>
                            <tr>
                                <td colspan="3"><?php echo $jumlah; ?> </td>
                                <td colspan="3"><?php echo $data["nama"]; ?></td>
                                <td colspan="3" >
                                    <a href="kategori_detail.php?id=<?php echo $data["id"]; ?>" class="btn btn-info"><i class="fa-solid fa-circle-info"></i></a>
                                </td>
                            </tr> 
                        <?php   
                                    $jumlah++;         
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