<?php
header('Content-Type: application/json');
require_once 'db.php'; // your mysqli connection file

$review_id = isset($_GET['review_id']) ? intval($_GET['review_id']) : 0;

if ($review_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid review id']);
    exit;
}

// Fetch review
$review_sql = "SELECT * FROM reviews WHERE id = $review_id LIMIT 1";
$review_res = mysqli_query($conn, $review_sql);

if (!$review_res || mysqli_num_rows($review_res) == 0) {
    echo json_encode(['success' => false, 'message' => 'Review not found']);
    exit;
}

$review = mysqli_fetch_assoc($review_res);

// Fetch cafe
$cafe_id = intval($review['cafe_id']);
$cafe_sql = "SELECT * FROM cafes WHERE id = $cafe_id LIMIT 1";
$cafe_res = mysqli_query($conn, $cafe_sql);
$cafe = mysqli_fetch_assoc($cafe_res);

// Fetch user
$user_id = intval($review['user_id']);
$user_sql = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
$user_res = mysqli_query($conn, $user_sql);
$user = mysqli_fetch_assoc($user_res);

// Process images (assuming comma-separated in review.photo_url)
$images = [];
if (!empty($review['photo_url'])) {
    $images = explode(',', $review['photo_url']);
}

$response = [
    'success' => true,
    'review' => [
        'id' => $review['id'],
        'cafe_id' => $review['cafe_id'],
        'user_id' => $review['user_id'],
        'rating' => intval($review['rating']),
        'title' => $review['title'],
        'comment' => $review['comment'],
        'images' => $images,
        'created_at' => $review['created_at']
    ],
    'cafe' => [
        'id' => $cafe['id'],
        'name' => $cafe['name'],
        'address' => $cafe['address'],
        'photo_url' => $cafe['photo_url'] ?? '',
        'overall_rating' => intval($cafe['overall_rating'])
    ],
    'user' => [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email']
    ]
];

echo json_encode($response);
