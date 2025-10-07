// Array data produk
const products = [
  { name: "iPhone 15", price: 20000000, desc: "Smartphone terbaru dari Apple.", category: "Elektronik", image: "landscape.png" },
  { name: "Samsung Galaxy S23", price: 18000000, desc: "Smartphone flagship Samsung.", category: "Elektronik", image: "landscape.png" },
  { name: "T-Shirt Putih", price: 150000, desc: "Kaos nyaman 100% katun.", category: "Fashion", image: "landscape.png" },
  { name: "Jaket Denim", price: 350000, desc: "Jaket jeans stylish.", category: "Fashion", image: "landscape.png" },
  { name: "Blender Philips", price: 500000, desc: "Blender kuat untuk smoothie.", category: "Peralatan Rumah", image: "landscape.png" },
  { name: "Rice Cooker", price: 400000, desc: "Penanak nasi serbaguna.", category: "Peralatan Rumah", image: "landscape.png" },
  { name: "Novel Fiksi", price: 100000, desc: "Cerita seru penuh imajinasi.", category: "Buku", image: "landscape.png" },
  { name: "Buku Sains", price: 120000, desc: "Ilmu pengetahuan modern.", category: "Buku", image: "landscape.png" },
  { name: "Sepatu Lari", price: 750000, desc: "Ringan dan nyaman untuk olahraga.", category: "Olahraga", image: "landscape.png" },
  { name: "Sepatu Larii", price: 750000, desc: "Ringan dan nyaman untuk olahraga.", category: "Olahraga", image: "landscape.png" }
];

const container = document.getElementById("productContainer");
const filterSelect = document.getElementById("categoryFilter");
const searchInput = document.getElementById("searchInput");

// Fungsi menampilkan produk
function displayProducts(filteredProducts) {
  container.innerHTML = "";
  filteredProducts.forEach(p => {
    const card = `
      <div class="product-card">
        <img src="${p.image}" alt="${p.name}">
        <div class="product-name">${p.name}</div>
        <div class="product-desc">${p.desc}</div>
        <div class="product-price">Rp ${p.price.toLocaleString('id-ID')}</div>
        <div class="product-category">${p.category}</div>
        <button class="add-to-cart">Tambah ke Keranjang</button>
      </div>
    `;
    container.innerHTML += card;
  });
}

// Fungsi filter
function filterProducts() {
  const category = filterSelect.value;
  const search = searchInput.value.toLowerCase();
  const filtered = products.filter(p => 
    (category === "all" || p.category === category) &&
    p.name.toLowerCase().includes(search)
  );
  displayProducts(filtered);
}

// Event listener
filterSelect.addEventListener("change", filterProducts);
searchInput.addEventListener("input", filterProducts);

// Tampilkan semua produk pertama kali
displayProducts(products);
