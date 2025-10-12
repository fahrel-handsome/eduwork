-- Schema untuk ecommerce1
CREATE DATABASE IF NOT EXISTS ecommerce1; 
USE ecommerce1;

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_produk VARCHAR(150) NOT NULL,
  category VARCHAR(100) DEFAULT NULL,
  harga DECIMAL(12,2) NOT NULL DEFAULT 0,
  deskripsi TEXT,
  stok INT NOT NULL DEFAULT 0
);

-- contoh data
INSERT INTO products (nama_produk, category, harga, deskripsi, stok) VALUES
('Laptop Putih', 'Elektronik', 4090000, 'Laptop murah berkualitas', 10),
('Kursi Kayu', 'Furniture', 200000, 'Kursi kuat dan nyaman', 50),
('Kaos Fashion', 'Fashion', 461000, 'Kaos trendi', 97);

ALTER TABLE products ADD COLUMN gambar VARCHAR(255) NULL;

ALTER TABLE products ADD COLUMN nama VARCHAR(100) NULL;
