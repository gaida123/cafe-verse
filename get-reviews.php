<?php
include "db.php";

$cafe_id = intval($_GET['cafe_id'] ?? 0);
if (!$cafe_id) {
    echo json_encode([]);
    exit;
}

// Join reviews with users
$query = "SELECT r.*, r.id AS review_id, u.name AS user_name
          FROM reviews r
          JOIN users u ON r.user_id = u.id
          WHERE r.cafe_id = $cafe_id
          ORDER BY r.created_at DESC";

$result = mysqli_query($conn, $query);
$reviews = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Assuming images are stored in a JSON array in the DB
    // $row['images'] = json_decode($row['photo_url'] ?? '[]', true) ?: [];
    $reviews[] = $row;
}

header('Content-Type: application/json');
echo json_encode($reviews);
?>
