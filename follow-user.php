<?php
session_start();
require_once "db.php";
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "You must be logged in."]);
    exit();
}

$follower_id = $_SESSION['user_id'];
$following_id = $_POST['following_id'] ?? null;

if (!$following_id || $follower_id == $following_id) {
    echo json_encode(["success" => false, "message" => "Invalid user ID."]);
    exit();
}

// Check if already following
$sql = "SELECT * FROM followers WHERE follower_id = ? AND following_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $follower_id, $following_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res) > 0) {
    // Unfollow
    $delete = "DELETE FROM followers WHERE follower_id = ? AND following_id = ?";
    $stmt2 = mysqli_prepare($conn, $delete);
    mysqli_stmt_bind_param($stmt2, "ii", $follower_id, $following_id);
    mysqli_stmt_execute($stmt2);

    // Decrease follower count
    mysqli_query($conn, "UPDATE users SET followers_count = followers_count - 1 WHERE id = $following_id");

    echo json_encode(["success" => true, "action" => "unfollowed"]);
} else {
    // Follow
    $insert = "INSERT INTO followers (follower_id, following_id) VALUES (?, ?)";
    $stmt3 = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($stmt3, "ii", $follower_id, $following_id);
    mysqli_stmt_execute($stmt3);

    // Increase follower count
    mysqli_query($conn, "UPDATE users SET followers_count = followers_count + 1 WHERE id = $following_id");

    echo json_encode(["success" => true, "action" => "followed"]);
}
