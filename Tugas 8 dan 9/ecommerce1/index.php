<?php
include 'koneksi.php'; // koneksi ke database
$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Commerce — Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background-color: #343a40 !important;
    }
    .navbar-brand {
      font-weight: 600;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .card:hover {
      transform: scale(1.03);
    }
    .card img {
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }
    footer {
      margin-top: 50px;
      background: #343a40;
      color: white;
      padding: 15px 0;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-dark navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand text-white" href="#">E-Commerce1</a>
      <div class="d-flex">
        <a href="admin/admin_products.php" class="btn btn-outline-light">Admin Panel</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="container mt-5 text-center">
    <h1 class="fw-bold mb-3">Selamat Datang di E-Commerce1</h1>
    <p class="text-muted">Temukan produk terbaik pilihanmu dengan harga terjangkau.</p>
  </div>

  <!-- Produk Section -->
  <div class="container mt-5">
    <div class="row g-4">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 col-sm-6">
          <div class="card">
            <?php if(!empty($row['gambar'])): ?>
              <img src="img/<?= htmlspecialchars($row['gambar']); ?>" class="card-img-top" alt="Gambar Produk">
            <?php else: ?>
              <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="No Image">
            <?php endif; ?>

            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['nama'] ?? $row['nama_produk'] ?? 'Nama tidak tersedia'); ?></h5>
              <p class="card-text text-muted"><?= htmlspecialchars($row['deskripsi']); ?></p>
              <p class="fw-bold text-primary">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <footer>
    <p>© <?= date("Y"); ?> E-Commerce1 | Dibuat dengan ❤️ oleh Admin</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
