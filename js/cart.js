function printCart() {
    window.print(); 
localStorage.removeItem('cart');
}

const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

const cartItemsBody = document.getElementById("cartItems");
let totalPrice = 0;
cartItems.forEach(item => {
    const row = document.createElement("tr");

    const nameCell = document.createElement("td");
    nameCell.textContent = item.name;

    const qtyCell = document.createElement("td");
    qtyCell.textContent = item.quantity;

    const priceCell = document.createElement("td");
    priceCell.textContent = `${(item.quantity * item.price).toFixed(2)} SAR`;

    row.append(nameCell, qtyCell, priceCell);
    cartItemsBody.appendChild(row);
    totalPrice += item.quantity * item.price;
});

const totalDiv = document.getElementById("total");
totalDiv.textContent = `Total: ${totalPrice.toFixed(2)} SAR`;