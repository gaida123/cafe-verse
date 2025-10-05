<?php
include "db.php";

$query = "
    SELECT c.id, c.name, c.address, AVG(r.rating) as avg_rating, COUNT(r.id) as review_count
    FROM cafes c
    LEFT JOIN reviews r ON c.id = r.cafe_id
    WHERE r.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    GROUP BY c.id
    ORDER BY avg_rating DESC, review_count DESC
    LIMIT 5
";

$result = mysqli_query($conn, $query);
$cafes = [];

while ($row = mysqli_fetch_assoc($result)) {
    $cafes[] = $row;
}

header('Content-Type: application/json');
echo json_encode($cafes);
?>
