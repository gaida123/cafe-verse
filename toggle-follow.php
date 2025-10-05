<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id']) || !isset($_POST['target_id'])) {
    die("Unauthorized");
}

$follower_id = (int)$_SESSION['user_id'];
$followed_id = (int)$_POST['target_id'];

// Check if already following
$check = "SELECT * FROM followers WHERE follower_id = $follower_id AND followed_id = $followed_id";
$res = mysqli_query($conn, $check);

if (mysqli_num_rows($res) > 0) {
    // Unfollow
    mysqli_query($conn, "DELETE FROM followers WHERE follower_id = $follower_id AND followed_id = $followed_id");
    mysqli_query($conn, "UPDATE users SET followers = followers - 1 WHERE id = $followed_id");
} else {
    // Follow
    mysqli_query($conn, "INSERT INTO followers (follower_id, followed_id) VALUES ($follower_id, $followed_id)");
    mysqli_query($conn, "UPDATE users SET followers = followers + 1 WHERE id = $followed_id");
}

header("Location: user-profile.php?id=$followed_id");
exit;
