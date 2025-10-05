<?php
session_start();
require_once "db.php";

header('Content-Type: application/json');

// Must be logged in
if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "message" => "You must be logged in."]);
    exit();
}

$user_id = $_SESSION["user_id"];
$cafe_id = $_POST["cafe_id"] ?? null;
$title = $_POST["title"] ?? null;
$rating = $_POST["rating"] ?? null;
$comment = trim($_POST["comment"] ?? "");

if (!$cafe_id || !$rating || empty($comment)) {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
    exit();
}

// Handle image uploads
$uploadDir = "uploads/reviews/";
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

$photoUrls = [];

foreach (["photo_1", "photo_2"] as $key) {
    if (isset($_FILES[$key]) && $_FILES[$key]["error"] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES[$key]["name"], PATHINFO_EXTENSION);
        $filename = uniqid("review_") . "." . $ext;
        move_uploaded_file($_FILES[$key]["tmp_name"], $uploadDir . $filename);
        $photoUrls[] = $uploadDir . $filename;  // Add photo URL to the array
    }
}

// Combine the photo URLs (if any) into a single string, separated by commas
$photoUrlString = implode(",", $photoUrls);

// Insert into DB
$sql = "INSERT INTO reviews (cafe_id, user_id, rating, title, comment, photo_url)
        VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iiiss", $cafe_id, $user_id, $rating, $title, $comment, $photoUrlString);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["success" => true, "message" => "Review added successfully!"]);

    if (mysqli_stmt_execute($stmt)) {
        // ✅ Update user's rating count
        $update = "UPDATE users 
               SET ratings_count = ratings_count + 1 
               WHERE id = ?";
        $stmt2 = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($stmt2, "i", $user_id);
        mysqli_stmt_execute($stmt2);

        // ✅ Fetch updated rating count to determine if points should increase
        $result = mysqli_query($conn, "SELECT ratings_count FROM users WHERE id = $user_id");
        $row = mysqli_fetch_assoc($result);
        $ratings_count = $row['ratings_count'];

        // ✅ Every 10 reviews = +1 point
        if ($ratings_count % 10 == 0) {
            $addPoints = "UPDATE users SET points = points + 1 WHERE id = $user_id";
            mysqli_query($conn, $addPoints);
        }

        echo json_encode(["success" => true, "message" => "Review added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Database error."]);
}
