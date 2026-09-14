<?php
include 'auth.php';
include 'connect.php';

$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    header("Location: admin.php");
    exit();
}

if (isset($_POST['update'])) {
    $item_name = $_POST['item_name'];
    $category  = $_POST['category'];
    $price     = $_POST['price'];
    $image     = $_POST['image'] ?: null;

    $stmt = $conn->prepare("UPDATE menu_items SET item_name=?, category=?, price=?, image=? WHERE id=?");
    $stmt->bind_param("ssdsi", $item_name, $category, $price, $image, $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
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
    <h2>Update Menu Item</h2>
    <form method="POST">
        <label>Item Name:</label>
        <input type="text" name="item_name" value="<?php echo htmlspecialchars($row['item_name']); ?>" required>

        <label>Category:</label>
        <select name="category" required>
            <?php
            $cats = ['Appetizer','Main Course','Dessert','Drinks'];
            foreach ($cats as $cat) {
                $selected = ($row['category'] === $cat) ? 'selected' : '';
                echo "<option value='$cat' $selected>$cat</option>";
            }
            ?>
        </select>

        <label>Price (SAR):</label>
        <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>

        <label>Image Path (optional):</label>
        <input type="text" name="image" value="<?php echo htmlspecialchars($row['image'] ?? ''); ?>" placeholder="photos/example.jpg">

        <button type="submit" name="update" class="btn-submit">Update Item</button>
        <a href="admin.php" class="btn-back">Back</a>
    </form>
</div>
</body>
</html>