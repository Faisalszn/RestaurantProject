function printCart() {
    window.print();
    localStorage.removeItem('cart');
    renderCart();
}

function removeItem(name) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(i => i.name !== name);
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
}

function renderCart() {
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsBody = document.getElementById("cartItems");
    const totalDiv = document.getElementById("total");
    cartItemsBody.innerHTML = "";

    if (cartItems.length === 0) {
        cartItemsBody.innerHTML = '<tr><td colspan="4" class="empty-cart">Your cart is empty. <a href="menu.html">Browse the menu</a> to add something.</td></tr>';
        totalDiv.textContent = "";
        return;
    }

    let totalPrice = 0;
    cartItems.forEach(item => {
        const row = document.createElement("tr");

        const nameCell = document.createElement("td");
        nameCell.textContent = item.name;

        const qtyCell = document.createElement("td");
        qtyCell.textContent = item.quantity;

        const priceCell = document.createElement("td");
        priceCell.textContent = `${(item.quantity * item.price).toFixed(2)} SAR`;

        const actionCell = document.createElement("td");
        const removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.className = "remove-btn";
        removeBtn.textContent = "Remove";
        removeBtn.addEventListener("click", () => removeItem(item.name));
        actionCell.appendChild(removeBtn);

        row.append(nameCell, qtyCell, priceCell, actionCell);
        cartItemsBody.appendChild(row);
        totalPrice += item.quantity * item.price;
    });

    totalDiv.textContent = `Total: ${totalPrice.toFixed(2)} SAR`;
}

document.addEventListener("DOMContentLoaded", renderCart);
