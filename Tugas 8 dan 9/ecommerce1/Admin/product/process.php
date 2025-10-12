<?php
include '../../koneksi.php';

if (isset($_POST['simpan'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama_produk'];
  $cat = $_POST['category'];
  $harga = $_POST['harga'];
  $desc = $_POST['deskripsi'];
  $stok = $_POST['stok'];

  if ($id) {
    $query = "UPDATE products SET nama_produk='$nama', category='$cat', harga='$harga', deskripsi='$desc', stok='$stok' WHERE id='$id'";
  } else {
    $query = "INSERT INTO products (nama_produk, category, harga, deskripsi, stok) VALUES ('$nama','$cat','$harga','$desc','$stok')";
  }

  mysqli_query($conn, $query);
  header("Location: index.php");
  exit;
}
?>
