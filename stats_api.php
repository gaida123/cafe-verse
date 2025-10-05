<?php
include "db.php";

$result = $conn->query("
  SELECT c.id, c.name, COUNT(r.id) AS reviews_this_week
  FROM cafes c
  JOIN reviews r ON c.id = r.cafe_id
  WHERE r.created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)
  GROUP BY c.id
  ORDER BY reviews_this_week DESC
  LIMIT 5
");

echo json_encode($result->fetch_all(MYSQLI_ASSOC));
?>
