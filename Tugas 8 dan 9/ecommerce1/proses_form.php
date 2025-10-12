<?php
// Ambil data dari form
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

// ===== Validasi Input =====
if (empty($nama) || empty($harga) || empty($deskripsi)) {
    echo "<h3 style='color:red;'>❌ Semua field wajib diisi!</h3>";
    echo "<a href='form_input.php'>⬅️ Kembali ke Form</a>";
    exit;
}

// ===== Koneksi ke Database =====
$koneksi = mysqli_connect("localhost", "root", "", "ecommerce1");

if (!$koneksi) {
    die("<h3 style='color:red;'>Koneksi gagal: " . mysqli_connect_error() . "</h3>");
}

// ===== Simpan Data ke Database =====
$query = "INSERT INTO products (nama_produk, harga, deskripsi, stok)
          VALUES ('$nama', '$harga', '$deskripsi', 10)";

if (mysqli_query($koneksi, $query)) {
    echo "<h3 style='color:green;'>✅ Produk berhasil ditambahkan!</h3>";
} else {
    echo "<h3 style='color:red;'>❌ Gagal menambahkan produk: " . mysqli_error($koneksi) . "</h3>";
}

// ===== Tombol kembali =====
echo "<a href='form_input.php'>⬅️ Kembali ke Form</a>";

// Tutup koneksi
mysqli_close($koneksi);
?>
