const productList = document.getElementById("product-list");
const cartItems = document.getElementById("cart-items");
const totalEl = document.getElementById("total");
const cartIcon = document.getElementById("cart-icon");
const cartCount = document.getElementById("cart-count");
const cartSidebar = document.getElementById("cart-sidebar");
const closeCartBtn = document.getElementById("close-cart");
const checkoutBtn = document.getElementById("checkout");
const overlay = document.getElementById("overlay");

let cart = [];

// Fungsi untuk mengambil dan menampilkan produk dari API
async function renderProducts() {
  try {
    const res = await fetch("https://fakestoreapi.com/products");
    const products = await res.json();

    products.forEach(product => {
      const div = document.createElement("div");
      div.className = "product-card";
      div.innerHTML = `
        <img src="${product.image}" alt="${product.title}">
        <h3>${product.title}</h3>
        <p>Rp ${product.price.toLocaleString()}</p>
        <button onclick='addToCart(${JSON.stringify(product)})'>+ Keranjang</button>
      `;
      productList.appendChild(div);
    });
  } catch (error) {
    console.error("Gagal mengambil data produk:", error);
  }
}

// Fungsi untuk menambahkan produk ke keranjang
function addToCart(product) {
  const existingItem = cart.find(item => item.id === product.id);
  if (existingItem) {
    existingItem.qty += 1;
  } else {
    cart.push({ ...product, qty: 1 });
  }
  renderCart();
}

// Fungsi untuk menampilkan isi keranjang
function renderCart() {
  cartItems.innerHTML = "";
  let total = 0;
  let count = 0;

  cart.forEach(item => {
    const li = document.createElement("li");
    li.innerHTML = `
      <span>${item.title} x${item.qty}</span>
      <div>
        <span>Rp ${(item.price * item.qty).toLocaleString()}</span>
        <button onclick="removeItem(${item.id})">&times;</button>
      </div>
    `;
    cartItems.appendChild(li);
    total += item.price * item.qty;
    count += item.qty;
  });

  totalEl.textContent = total.toLocaleString();
  cartCount.textContent = count;
}

// Fungsi untuk menghapus item dari keranjang
function removeItem(id) {
  cart = cart.filter(item => item.id !== id);
  renderCart();
}

// Event listeners untuk membuka dan menutup keranjang
cartIcon.addEventListener("click", () => {
  cartSidebar.classList.add("open");
  overlay.classList.add("show");
});

closeCartBtn.addEventListener("click", () => {
  cartSidebar.classList.remove("open");
  overlay.classList.remove("show");
});

overlay.addEventListener("click", () => {
  cartSidebar.classList.remove("open");
  overlay.classList.remove("show");
});

// Event listener untuk tombol checkout
checkoutBtn.addEventListener("click", () => {
  if (cart.length === 0) {
    alert("Keranjang kosong!");
    return;
  }
  alert("Terima kasih telah berbelanja!\nTotal: Rp " + totalEl.textContent);
  cart = [];
  renderCart();
  cartSidebar.classList.remove("open");
  overlay.classList.remove("show");
});

// Panggil fungsi untuk menampilkan produk saat halaman dimuat
renderProducts();


