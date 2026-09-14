<?php
include 'auth.php';
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

<div class="container">
    <h2>Menu Items Manager</h2>
    <p class="admin-meta">Logged in as <?php echo htmlspecialchars($_SESSION['admin_username']); ?> &mdash; <a href="logout.php">Log Out</a></p>
    <a href="insert.php" class="btn-add">+ Add New Item</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Price (SAR)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT * FROM menu_items";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                echo "<td>" . number_format($row['price'], 2) . " SAR</td>";
                echo "<td>
                    <a href='update.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a>
                    <a href='delete.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Delete this item?\")'>Delete</a>
                </td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>