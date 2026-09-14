<?php
include 'auth.php';
include 'connect.php';
$message = "";

if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $category  = $_POST['category'];
    $price     = $_POST['price'];
    $image     = $_POST['image'] ?: null;

    $stmt = $conn->prepare("INSERT INTO menu_items (item_name, category, price, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $item_name, $category, $price, $image);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        $message = "Error inserting item.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMTAwIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgcng9IjIyIiBmaWxsPSIjRDM1MDRBIi8+PHRleHQgeD0iNTAiIHk9IjcwIiBmb250LXNpemU9IjU4IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIj7wn420PC90ZXh0Pjwvc3ZnPgo=">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Template.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<header>
    <h1>Restaurant</h1>
    <input type="checkbox" id="navToggle" class="nav-toggle">
    <label for="navToggle" class="nav-toggle-label">&#9776;</label>
    <nav>
        <a href="index.html">Home</a>
        <a href="menu.html">Menu</a>
        <a href="cart.html">Cart</a>
        <a href="me.html">About Me</a>
        <a href="admin.php" class="active">Admin</a>
    </nav>
</header>

<div class="container form-container">
    <h2>Add New Menu Item</h2>
    <?php if ($message) echo "<p class='msg'>$message</p>"; ?>
    <form method="POST">
        <label>Item Name:</label>
        <input type="text" name="item_name" required>

        <label>Category:</label>
        <select name="category" required>
            <option value="">-- Select --</option>
            <option value="Appetizer">Appetizer</option>
            <option value="Main Course">Main Course</option>
            <option value="Dessert">Dessert</option>
            <option value="Drinks">Drinks</option>
        </select>

        <label>Price (SAR):</label>
        <input type="number" step="0.01" name="price" required>

        <label>Image Path (optional):</label>
        <input type="text" name="image" placeholder="photos/example.jpg">

        <button type="submit" name="submit" class="btn-submit">Add Item</button>
        <a href="admin.php" class="btn-back">Back</a>
    </form>
</div>
</body>
</html>