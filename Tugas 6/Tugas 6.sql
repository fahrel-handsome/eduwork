CREATE DATABASE ecommerce;
USE ecommerce;

-- Tabel products
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    deskripsi TEXT,
    stok INT NOT NULL
);

-- Tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Tabel orders
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT,
    total DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO products (nama_produk, harga, deskripsi, stok)
VALUES 
('Laptop Asus', 8500000, 'Laptop untuk kebutuhan kantor dan kuliah', 10),
('Headphone Sony', 1200000, 'Headphone wireless dengan noise cancelling', 25);

SELECT * FROM products;

UPDATE products
SET harga = 9000000, stok = 8
WHERE id = 1;

DELETE FROM products
WHERE id = 2;
