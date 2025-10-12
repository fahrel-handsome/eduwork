<?php
include '../../koneksi.php';

// proses simpan data ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $category = $_POST['category'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $gambar = '';

    // Proses upload gambar
    if (!empty($_FILES['gambar']['name'])) {
        $folderTujuan = '../../img/'; // simpan di folder img
        if (!is_dir($folderTujuan)) {
            mkdir($folderTujuan, 0777, true);
        }

        $gambar = time() . '_' . basename($_FILES['gambar']['name']);
        $target_file = $folderTujuan . $gambar;

        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            echo "<script>alert('Gagal mengupload gambar!');</script>";
        }
    }

    // Simpan ke database
    $query = "INSERT INTO products (nama_produk, category, harga, deskripsi, stok, gambar)
              VALUES ('$nama_produk', '$category', '$harga', '$deskripsi', '$stok', '$gambar')";
    mysqli_query($conn, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="mb-4">Tambah Produk</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar Produk</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
