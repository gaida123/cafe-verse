<?php
include "db.php";

$cafe_id = intval($_GET['cafe_id'] ?? 0);
if (!$cafe_id) {
    echo json_encode([]);
    exit;
}

// Fetch cafe info
$query = "SELECT id, name, address, lat, lng FROM cafes WHERE id = $cafe_id LIMIT 1";
$result = mysqli_query($conn, $query);
$cafe = mysqli_fetch_assoc($result) ?: [];

header('Content-Type: application/json');
echo json_encode($cafe);
