<?php
include '../../koneksi.php';

$id = $_GET['id'];

// Ambil data gambar dulu biar bisa dihapus dari folder
$result = mysqli_query($conn, "SELECT gambar FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($result);
if ($row['gambar'] && file_exists("img/" . $row['gambar'])) {
    unlink("img/" . $row['gambar']);
}

// Hapus dari database
mysqli_query($conn, "DELETE FROM products WHERE id=$id");

header("Location: index.php");
exit();
?>
