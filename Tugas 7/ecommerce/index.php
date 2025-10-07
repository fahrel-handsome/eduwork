<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            padding: 30px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        a {
            text-decoration: none;
            padding: 8px 12px;
            background-color: #2ecc71;
            color: white;
            border-radius: 5px;
        }
        a:hover {
            background-color: #27ae60;
        }
        .top {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="top">
        <h2>Daftar Produk</h2>
        <a href="form_input.php">➕ Tambah Produk</a>
    </div>

    <?php
    $koneksi = mysqli_connect("localhost", "root", "", "ecommerce");

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM products";
    $hasil = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($hasil) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nama Produk</th><th>Harga</th><th>Deskripsi</th><th>Stok</th></tr>";
        while ($row = mysqli_fetch_assoc($hasil)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nama_produk']}</td>
                    <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                    <td>{$row['deskripsi']}</td>
                    <td>{$row['stok']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>Belum ada produk yang ditambahkan.</p>";
    }

    mysqli_close($koneksi);
    ?>
</body>
</html>
