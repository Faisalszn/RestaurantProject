<?php
include 'connect.php';
header('Content-Type: application/json');

$items = [];
$result = $conn->query("SELECT item_name, category, price, image FROM menu_items ORDER BY category, item_name");
while ($row = $result->fetch_assoc()) {
    $items[] = [
        'name'     => $row['item_name'],
        'category' => $row['category'],
        'price'    => (float) $row['price'],
        'image'    => $row['image'],
    ];
}

echo json_encode($items);
