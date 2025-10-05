<?php
session_start();
require_once "db.php"; // your mysqli connection

// 1. Get user ID from URL
if (!isset($_GET['id'])) {
    die("User ID not provided.");
}
$target_id = (int)$_GET['id'];

// 2. Fetch user data
$query = "SELECT username, name, followers, ratings_count, points FROM users WHERE id = $target_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

// 3. Check if logged-in user follows this user
$isFollowing = false;
if (isset($_SESSION['user_id'])) {
    $follower_id = $_SESSION['user_id'];
    $check = "SELECT * FROM followers WHERE follower_id = $follower_id AND followed_id = $target_id";
    $res = mysqli_query($conn, $check);
    if (mysqli_num_rows($res) > 0) {
        $isFollowing = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($user['username']); ?>’s Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="text-align:center; margin-top:40px;">
        <h1>@<?php echo htmlspecialchars($user['username']); ?></h1>
        <h1><?php echo htmlspecialchars($user['name']); ?></h1>

        <p><strong>Followers:</strong> <?php echo $user['followers']; ?></p>
        <p><strong>Ratings:</strong> <?php echo $user['ratings_count']; ?></p>
        <p><strong>Points:</strong> <?php echo $user['points']; ?></p>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $target_id): ?>
            <form method="POST" action="toggle-follow.php">
                <input type="hidden" name="target_id" value="<?php echo $target_id; ?>">
                <button type="submit" style="padding:10px 20px; border:none; border-radius:8px; background-color:#5F4024; color:white; cursor:pointer;">
                    <?php echo $isFollowing ? 'Unfollow' : 'Follow'; ?>
                </button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
