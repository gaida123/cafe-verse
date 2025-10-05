<?php
require_once "db.php";
header("Content-Type: application/json");

$user_id = $_GET['user_id'] ?? null;
if (!$user_id) {
    echo json_encode(["success" => false, "message" => "Missing user ID"]);
    exit();
}

$sql = "SELECT id, name, followers, ratings_count, points FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
    echo json_encode(["success" => true, "user" => $user]);
} else {
    echo json_encode(["success" => false, "message" => "User not found"]);
}
