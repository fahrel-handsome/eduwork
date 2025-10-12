<?php
$conn = mysqli_connect("localhost", "root", "", "ecommerce1");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
