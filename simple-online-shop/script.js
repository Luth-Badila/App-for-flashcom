const products = [
  { id: 1, name: "Baju Kaos", price: 100000, image: "https://via.placeholder.com/200x150?text=Baju" },
  { id: 2, name: "Celana Jeans", price: 150000, image: "https://via.placeholder.com/200x150?text=Celana" },
  { id: 3, name: "Sepatu", price: 250000, image: "https://via.placeholder.com/200x150?text=Sepatu" },
  { id: 4, name: "Topi", price: 50000, image: "https://via.placeholder.com/200x150?text=Topi" }
];

let cart = [];

const productList = document.getElementById("product-list");
const cartItems = document.getElementById("cart-items");
const totalEl = document.getElementById("total");
const cartIcon = document.getElementById("cart-icon");
const cartCount = document.getElementById("cart-count");
const cartSidebar = document.getElementById("cart-sidebar");
const closeCartBtn = document.getElementById("close-cart");
const checkoutBtn = document.getElementById("checkout");
const overlay = document.getElementById("overlay");

// Tampilkan produk
products.forEach(product => {
  const div = document.createElement("div");
  div.className = "product-card";
  div.innerHTML = `
    <img src="${product.image}" alt="${product.name}">
    <h3>${product.name}</h3>
    <p>Rp ${product.price.toLocaleString()}</p>
    <button onclick="addToCart(${product.id})">+ Keranjang</button>
  `;
  productList.appendChild(div);
});

function renderCart() {
  cartItems.innerHTML = "";
  let total = 0;
  let count = 0;

  cart.forEach(item => {
    const li = document.createElement("li");
    li.innerHTML = `
      <span>${item.name} x${item.qty}</span>
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

function addToCart(productId) {
  const product = products.find(p => p.id === productId);
  const item = cart.find(i => i.id === productId);

  if (item) {
    item.qty += 1;
  } else {
    cart.push({ ...product, qty: 1 });
  }

  renderCart();
}

// Hapus item
function removeItem(id) {
  cart = cart.filter(item => item.id !== id);
  renderCart();
}

// Show/Hide Cart
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

// Checkout
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
