let cart = JSON.parse(localStorage.getItem("cart")) || [];

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function openCart() {
  document.getElementById("cartSidebar").style.right = "0";
  renderCart();
}

function closeCart() {
  document.getElementById("cartSidebar").style.right = "-400px";
}

function addToCart(name, price) {
  let existing = cart.find(item => item.name === name);
  if (existing) {
    existing.qty++;
  } else {
    cart.push({ name, price, qty: 1 });
  }
  saveCart();
  renderCart();
}

function removeFromCart(index) {
  cart.splice(index, 1);
  saveCart();
  renderCart();
}

function updateQty(index, value) {
  cart[index].qty = parseInt(value) || 1;
  saveCart();
  renderCart();
}

function clearCart() {
  cart = [];
  saveCart();
  renderCart();
}

function renderCart() {
  let cartItems = document.getElementById("cartItems");
  let cartTotal = document.getElementById("cartTotal");
  cartItems.innerHTML = "";
  let total = 0;

  cart.forEach((item, index) => {
    let div = document.createElement("div");
    div.className = "cart-item";
    div.innerHTML = `
      <span>${item.name} (₹${item.price})</span>
      <input type="number" min="1" value="${item.qty}" 
             onchange="updateQty(${index}, this.value)">
      <button class="btn primary" onclick="removeFromCart(${index})">Remove</button>
    `;
    cartItems.appendChild(div);
    total += item.price * item.qty;
  });

  cartTotal.textContent = total;
}