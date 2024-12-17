<?php
// connect  to  database
$con = mysqli_connect("localhost", "root", "", "toko_online");

// Cek connect
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
