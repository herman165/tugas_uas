<?php 
    require "session.php";
    require "../koneksi.php";

    $id = $_GET["id"];

    $query = mysqli_query($con, "SELECT p.*, k.nama AS kategori_nama FROM produk p JOIN kategori k ON p.kategori_id = k.id WHERE p.id = '$id'");

    $data = mysqli_fetch_array($query);
    
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id != '$data[kategori_id]'");
    
     function generateRandomString($length = 10) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk_Detail- Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    form div{
        margin-bottom: 10px;
    }
</style>

<body>
    <?php 
        require "navbar.php";
    ?>

    <div class="container mt-5">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6 mb-4">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data["nama"]; ?>">
                </div>
                  <div>
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required>
                       <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['kategori_nama']; ?></option>
                        <?php while ($dataKategori = mysqli_fetch_array($queryKategori)) { ?>
                            <option value="<?php echo $dataKategori["id"]; ?>"><?php echo $dataKategori["nama"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="<?php echo $data['harga']; ?>">
                </div>
                <div>
                    <label for="currentFoto" class="form-label">Foto Produk Saat Ini</label>
                    <img src="../image/<?php echo $data["foto"]; ?>" alt="" width="100">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail" class="form-label">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="3" class="form-control" placeholder="Masukkan Deskripsi Produk"><?php echo $data["detail"]; ?></textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok" class="form-label">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-select">
                        <option value="<?php echo $data["ketersediaan_stok"]; ?>">tersedia</option>
                        <?php
                            if($data["ketersediaan_stok"] == "tersedia"){
                        ?>
                            <option value="habis">habis</option>
                        <?php        
                            }
                            else{
                        ?>
                            <option value="tersedia">tersedia</option>
                        <?php        
                            }
                        ?>
                    </select>
                </div>
                <div class="justify-content-between d-flex">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>

                    
                </div>
            </form>
            <?php 
                if(isset($_POST["update"])){
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

                    if($nama=="" || $kategori=="" || $harga==""){
            ?>
                        <div class="alert alert-danger mt-3" role="alert">Data Tidak Boleh Kosong</div>
            <?php            
                    }
                    else{
                        $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id = '$kategori', nama = '$nama', harga = '$harga', foto = '$new_name', detail = '$detail', ketersediaan_stok = '$ketersediaan_stok' WHERE id = '$id'");

                        if($nama_file != ""){
                            if($image_size > 5000000) {
            ?>
                               <div class="alert alert-danger mt-3 " role="alert">
                                   Foto tidak sesuai (ukuran > 5MB)
                               </div>
            <?php                    
                            }
                            else{
                                 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
            ?>
                                    <div class="alert alert-danger mt-3" role="alert">
                                        Foto tidak sesuai (format salah)
                                    </div>
            <?php                         
                                 } 
                                 else{
                                     move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                                     $queryUpdate == mysqli_query($con, "UPDATE produk SET foto = '$new_name' WHERE id = '$id'");


                                     if($queryUpdate){
            ?>
                                        <div class="alert alert-success mt-3">
                                            Produk Berhasil Diupdate
                                        </div>

                                        <meta http-equiv="refresh" content="1; url=product.php">
            <?php                            
                                     }
                                     else{
                                        echo mysqli_error($con);
                                     }
                                 }  
                            }
                        }

                    }    
                } 
                
                if(isset($_POST["hapus"])){
                    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id = '$id'");

                    if($queryHapus){
            ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Produk Berhasil Dihapus
                        </div>
                        <meta http-equiv="refresh" content="1; url=product.php">
            <?php            
                    }
                }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>