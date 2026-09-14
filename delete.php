<?php
include 'auth.php';
include 'connect.php';

$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin.php");
    exit();
} else {
    echo "Error deleting item: " . htmlspecialchars($conn->error);
}
?>