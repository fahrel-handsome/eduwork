<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            padding: 30px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 320px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h2>Form Tambah Produk</h2>
    <form action="proses_form.php" method="POST">
        <label>Nama Produk:</label><br>
        <input type="text" name="nama"><br><br>

        <label>Harga:</label><br>
        <input type="number" name="harga"><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="3"></textarea><br><br>

        <button type="submit">Simpan Produk</button>
    </form>
</body>
</html>
