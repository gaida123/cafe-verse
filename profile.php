<?php
require_once "db.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

$username = $_SESSION["username"];

$sql = "SELECT * FROM users WHERE username = '$username'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php
    require_once "header.php";
    ?>
    <style>
        .profile-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            flex-direction: column;
            text-align: center;
        }

        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
        }

        .account-name {
            font-size: 32px;
            font-weight: 600;
            margin-top: 20px;
            color: white;
        }

        .info-cards {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 30px;
        }

        .info-card {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            text-align: center;
        }

        .info-card p {
            font-size: 18px;
            margin: 0;
            font-weight: 500;
        }

        .btn-logout {
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #FF3B3B;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #ff1a1a;
        }

        .container-fluid {
            padding: 0;
        }
    </style>
</head>

<body>

    <?php
    require_once "loading-page.php";
    ?>
    <?php
    require_once "menu.php";
    ?>

    <div class="home-page">
        <div class="container">
            <div class="profile-header">
                <img src="img/profile-logo-creme.svg" alt="Profile Image">
                <h1 class="account-name" id="user-name"></h1>
            </div>

            <div class="info-cards">
                <div class="info-card">
                    <p id="followers">Followers</p>
                </div>
                <div class="info-card">
                    <p id="ratings">Ratings</p>
                </div>
                <div class="info-card">
                    <p id="points">Points</p>
                </div>
            </div>

            <div class="info-cards text-center">
                <a href="logout" class="btn-logout mt-5">Logout</a>
            </div>
        </div>
    </div>

    <script>
        fetch(`get-user-profile.php?user_id=${userId}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const u = data.user;
                    document.getElementById('user-name').textContent = u.name;
                    document.getElementById('followers').textContent = `${u.followers} Followers`;
                    document.getElementById('ratings').textContent = `${u.ratings_count} Ratings`;
                    document.getElementById('points').textContent = `${u.points} Points`;
                }
            });
    </script>

</body>

</html>