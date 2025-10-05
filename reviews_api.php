<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $cafe_id = $_GET['cafe_id'];
  $result = $conn->query("
    SELECT u.name, r.rating, r.comment, r.created_at
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    WHERE r.cafe_id = $cafe_id
    ORDER BY r.created_at DESC
  ");
  echo json_encode($result->fetch_all(MYSQLI_ASSOC));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);
  $cafe_id = $data['cafe_id'];
  $user_id = $data['user_id'];
  $rating = $data['rating'];
  $comment = $conn->real_escape_string($data['comment']);

  $stmt = $conn->prepare("INSERT INTO reviews (cafe_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("iiis", $cafe_id, $user_id, $rating, $comment);
  $stmt->execute();

  echo json_encode(["success" => true]);
}
?>
