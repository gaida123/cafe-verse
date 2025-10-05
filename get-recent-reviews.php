<?php
include "db.php";

// Expect an array of cafe IDs, comma-separated
$cafe_ids = $_GET['cafe_ids'] ?? '';
$limit = $_GET['limit'] ?? '';
if (!$cafe_ids) {
    echo json_encode([]);
    exit;
}

// Make sure IDs are safe
$cafe_ids_safe = implode(',', array_map('intval', explode(',', $cafe_ids)));

// Query to get recent reviews with user name and photo_url
$query = "SELECT r.id, r.cafe_id, r.user_id, r.rating, r.title, r.comment, r.created_at, r.photo_url, u.name AS user_name
          FROM reviews r
          JOIN users u ON r.user_id = u.id
          WHERE r.cafe_id IN ($cafe_ids_safe)
          ORDER BY r.created_at DESC
          LIMIT $limit";

$result = mysqli_query($conn, $query);

$reviews = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = [
        'id' => $row['id'],
        'cafe_id' => $row['cafe_id'],
        'user_id' => $row['user_id'],
        'user_name' => $row['user_name'],
        'rating' => $row['rating'],
        'title' => $row['title'],
        'comment' => $row['comment'],
        'photo_url' => $row['photo_url'] ?: 'img/review-placeholder.jpg', // default if empty
        'created_at' => $row['created_at']
    ];
}

header('Content-Type: application/json');
echo json_encode($reviews);
?>
