<?php
include '../../koneksi.php';

// Ambil data produk berdasarkan ID
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($result);

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $category = $_POST['category'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $gambar_lama = $_POST['gambar_lama'];

    // Lokasi folder penyimpanan gambar
    $folderTujuan = '../../img/';

    // Pastikan folder tujuan ada
    if (!is_dir($folderTujuan)) {
        mkdir($folderTujuan, 0777, true);
    }

    // Upload gambar baru jika ada
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $namaFile = time() . '_' . basename($_FILES['gambar']['name']);
        $target = $folderTujuan . $namaFile;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            // Hapus gambar lama (jika ada)
            if (!empty($gambar_lama) && file_exists($folderTujuan . $gambar_lama)) {
                unlink($folderTujuan . $gambar_lama);
            }
        } else {
            $namaFile = $gambar_lama; // kalau gagal upload, tetap pakai gambar lama
        }
    } else {
        $namaFile = $gambar_lama; // tidak ada file baru, gunakan yang lama
    }

    // Update data produk di database
    $query = "UPDATE products SET 
                nama_produk='$nama_produk',
                category='$category',
                harga='$harga',
                deskripsi='$deskripsi',
                stok='$stok',
                gambar='$namaFile'
              WHERE id=$id";
    mysqli_query($conn, $query);

    // Arahkan kembali ke halaman index
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-3">Edit Produk</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="gambar_lama" value="<?= $row['gambar']; ?>">
        
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($row['nama_produk']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($row['category']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($row['harga']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($row['deskripsi']); ?></textarea>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="<?= htmlspecialchars($row['stok']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Gambar Produk</label><br>
            <?php if (!empty($row['gambar'])): ?>
                <img src="../../img/<?= htmlspecialchars($row['gambar']); ?>" width="100" class="mb-2 rounded border">
            <?php endif; ?>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
