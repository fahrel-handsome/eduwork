<?php
include_once('../../koneksi.php');

// --- MODE EDIT ---
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$data = ['nama_produk'=>'','category'=>'','harga'=>'','stok'=>'','deskripsi'=>'','gambar'=>''];

if ($id > 0) {
  $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
  $data = mysqli_fetch_assoc($res);
}

// --- SIMPAN DATA ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = mysqli_real_escape_string($conn, $_POST['nama_produk']);
  $kategori = mysqli_real_escape_string($conn, $_POST['category']);
  $harga = (float)$_POST['harga'];
  $stok = (int)$_POST['stok'];
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  
  $gambarBaru = $data['gambar'];
  if (!empty($_FILES['gambar']['name'])) {
    $gambarBaru = time() . '_' . $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../img/" . $gambarBaru);
  }

  if ($id > 0) {
    // update
    $sql = "UPDATE products SET 
              nama_produk='$nama', category='$kategori', harga=$harga, stok=$stok,
              deskripsi='$deskripsi', gambar='$gambarBaru'
            WHERE id=$id";
  } else {
    // insert baru
    $sql = "INSERT INTO products (nama_produk, category, harga, stok, deskripsi, gambar)
            VALUES ('$nama', '$kategori', $harga, $stok, '$deskripsi', '$gambarBaru')";
  }

  mysqli_query($conn, $sql);
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $id ? 'Edit Produk' : 'Tambah Produk' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-success text-white">
      <h4 class="mb-0"><?= $id ? 'Edit Produk' : 'Tambah Produk Baru' ?></h4>
    </div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Nama Produk</label>
          <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($data['nama_produk']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="category" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            <option <?= $data['category']=='Elektronik'?'selected':'' ?>>Elektronik</option>
            <option <?= $data['category']=='Furniture'?'selected':'' ?>>Furniture</option>
            <option <?= $data['category']=='Fashion'?'selected':'' ?>>Fashion</option>
          </select>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($data['harga']) ?>" required>
          </div>
          <div class="col">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="<?= htmlspecialchars($data['stok']) ?>" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Gambar Produk</label><br>
          <?php if ($data['gambar']): ?>
            <img src="../img/<?= $data['gambar'] ?>" width="100" class="mb-2 rounded"><br>
          <?php endif; ?>
          <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
