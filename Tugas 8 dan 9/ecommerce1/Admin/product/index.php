<?php
include_once('../../koneksi.php');

// ambil data
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$query = "SELECT * FROM products WHERE 1=1";
if ($cari != '') $query .= " AND nama_produk LIKE '%$cari%'";
if ($kategori != '') $query .= " AND category = '$kategori'";
$result = mysqli_query($conn, $query);
$totalProduk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Produk | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f4f6f9; font-family: 'Poppins', sans-serif; }
    .sidebar { width:230px; background-color:#2c3e50; height:100vh; position:fixed; padding-top:20px; }
    .sidebar a { color:white; display:block; padding:10px 20px; text-decoration:none; }
    .sidebar a:hover, .active { background-color:#1abc9c; }
    .content { margin-left:240px; padding:30px; }
  </style>
</head>
<body>
  <div class="sidebar">
    <h4 class="text-center text-white mb-4">Admin Panel</h4>
    <a href="../dashboard.php">Dashboard</a>
    <a href="index.php" class="active">Kelola Produk</a>
    <a href="../orders.php">Pesanan</a>
    <a href="../users.php">Pengguna</a>
    <a href="../../index.php">Kembali ke Home</a>
  </div>

  <div class="content">
    <h3 class="mb-4 fw-bold">Kelola Produk</h3>

    <div class="card mb-4">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6>Total Produk</h6>
          <h3 class="text-success"><?= $totalProduk ?></h3>
        </div>
        <a href="tambah.php" class="btn btn-success">+ Tambah Produk</a>
      </div>
    </div>

    <form method="GET" class="row g-2 mb-3">
      <div class="col-md-5">
        <input type="text" name="cari" class="form-control" placeholder="Cari produk..." value="<?= htmlspecialchars($cari) ?>">
      </div>
      <div class="col-md-4">
        <select name="kategori" class="form-select" onchange="this.form.submit()">
          <option value="">Semua Kategori</option>
          <option value="Elektronik" <?= $kategori=='Elektronik'?'selected':'' ?>>Elektronik</option>
          <option value="Furniture" <?= $kategori=='Furniture'?'selected':'' ?>>Furniture</option>
          <option value="Fashion" <?= $kategori=='Fashion'?'selected':'' ?>>Fashion</option>
        </select>
      </div>
      <div class="col-md-3">
        <button class="btn btn-primary" type="submit">Cari</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
      </div>
    </form>

    <div class="card">
      <div class="card-header bg-info text-white">Daftar Produk</div>
      <div class="card-body">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>ID</th><th>Gambar</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td>
                <?php if (!empty($row['gambar'])): ?>
                  <img src='../../img/<?= htmlspecialchars($row['gambar']) ?>' width='60' height='60' class='rounded'>
                <?php else: ?>
                  <span class="text-muted">Tidak ada</span>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($row['nama_produk']) ?></td>
              <td><?= htmlspecialchars($row['category']) ?></td>
              <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
              <td><?= $row['stok'] ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk ini?')">🗑️</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
