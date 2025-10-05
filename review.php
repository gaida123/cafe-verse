<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Reviews | CafeVerse</title>
    <?php require_once "header.php"; ?>

    <style>
        .reviews-wrapper {
            max-width: 900px;
            margin: 100px auto;
            padding: 0 20px;
        }

        .reviews-title {
            text-align: center;
            color: #b49f8cff;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .reviews-subtext {
            text-align: center;
            color: #9B7E67;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .review-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(95, 64, 36, 0.08);
            padding: 20px;
            transition: all 0.25s ease;
            animation: fadeInUp 0.4s ease;
            position: relative;
        }

        .review-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 14px rgba(95, 64, 36, 0.15);
        }

        .review-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .review-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #FFF2E5;
        }

        .review-name {
            color: #5F4024;
            font-weight: 600;
            font-size: 15px;
        }

        .review-date {
            font-size: 12px;
            color: #B2947D;
        }

        .review-text {
            font-size: 14px;
            color: #5F4024;
            line-height: 1.5;
        }

        .review-rating {
            position: absolute;
            top: 18px;
            right: 18px;
            color: #F7B733;
            font-size: 14px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <?php require_once "menu.php"; ?>

    <?php
    require_once "header.php";
    require_once "menu.php";
    require_once "db.php";

    // Fetch 20 most recent reviews with user info
    $sql = "
    SELECT r.*, u.name
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    ORDER BY r.created_at DESC
    LIMIT 10
";
    $result = $conn->query($sql);
    ?>

    <div class="reviews-wrapper">
        <h3 class="reviews-title">💬 Recent Reviews</h3>
        <p class="reviews-subtext">See what other café lovers are saying about their latest experiences ☕</p>

        <div class="reviews-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($r = $result->fetch_assoc()) {
                    $name = htmlspecialchars($r['name']);
                    $date = date("M d, Y", strtotime($r['created_at']));
                    $text = htmlspecialchars($r['comment']);
                    $rating = intval($r['rating']);
                    $avatar = $r['avatar_url'] ?? "https://i.pravatar.cc/100?u=" . urlencode($name);
                    $stars = str_repeat("⭐", $rating);

                    echo "
                <div class='review-card'>
                    <div class='review-header'>
                        <img src='{$avatar}' alt='avatar' class='review-avatar'>
                        <div>
                            <div class='review-name'>{$name}</div>
                            <div class='review-date'>{$date}</div>
                        </div>
                    </div>
                    <div class='review-rating'>{$stars}</div>
                    <div class='review-text'>{$text}</div>
                </div>
                ";
                }
            } else {
                echo "<p style='text-align:center; color:#5F4024;'>No reviews yet. Be the first to leave one!</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>