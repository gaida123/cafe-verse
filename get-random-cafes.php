<?php
include "db.php";

$user_lat = floatval($_GET['lat']);
$user_lng = floatval($_GET['lng']);
$radius_km = 20; // e.g., 20 km radius

$query = "
SELECT id, name, address, lat, lng,
(6371 * acos(
    cos(radians($user_lat)) * cos(radians(lat)) * cos(radians(lng) - radians($user_lng))
    + sin(radians($user_lat)) * sin(radians(lat))
)) AS distance
FROM cafes
HAVING distance <= $radius_km
ORDER BY RAND()
LIMIT 3
";

$result = mysqli_query($conn, $query);

$cafes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cafes[] = $row;
}

header('Content-Type: application/json');
echo json_encode($cafes);
