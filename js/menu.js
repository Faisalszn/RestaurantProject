const categoryLabels = {
    "appetizers": "Appetizer",
    "main-course": "Main Course",
    "dessert": "Dessert",
    "drinks": "Drinks"
};

let menuItems = {};

async function loadMenu() {
    const response = await fetch('get_menu.php');
    const items = await response.json();

    menuItems = { appetizers: [], "main-course": [], dessert: [], drinks: [] };
    items.forEach(item => {
        const section = Object.keys(categoryLabels).find(key => categoryLabels[key] === item.category);
        if (section) {
            menuItems[section].push(item);
        }
    });
}

function showSection() {
    const section = document.getElementById("menu").value;
    if (!section) return;
    const menuItemsDiv = document.getElementById("menuItems");
    menuItemsDiv.innerHTML = "";

    (menuItems[section] || []).forEach(item => {
        const itemDiv = document.createElement("div");
        itemDiv.classList.add("menuItem");

        const img = document.createElement("img");
        img.src = item.image || "photos/restaurant.jpg";
        img.alt = item.name;

        const nameSpan = document.createElement("span");
        nameSpan.textContent = item.name;

        const select = document.createElement("select");
        [0, 1, 2, 3].forEach(qty => {
            const option = document.createElement("option");
            option.value = qty;
            option.textContent = qty;
            select.appendChild(option);
        });
        select.addEventListener("change", () => addToCart(select.value, item.name, item.price));

        const priceSpan = document.createElement("span");
        priceSpan.textContent = `${item.price.toFixed(2)} SAR`;

        itemDiv.append(img, nameSpan, select, priceSpan);
        menuItemsDiv.appendChild(itemDiv);
    });
}

function addToCart(quantity, itemName, price) {
    if (parseInt(quantity) === 0) return;
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const existing = cart.find(i => i.name === itemName);
    if (existing) {
        existing.quantity = parseInt(quantity);
    } else {
        cart.push({ name: itemName, quantity: parseInt(quantity), price: price });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
}

document.addEventListener("DOMContentLoaded", async () => {
    await loadMenu();
    document.getElementById("menu").addEventListener("change", showSection);
});
