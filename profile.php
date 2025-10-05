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
        .account-name {
            font-size: 100px;
        }

        .information-num {
            font-size: 50px;
            text-align: left;
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
    <div class="home-page" style="height: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="img/profile-logo-creme.svg" alt="profile-logo" style="width: 80%;">
                </div>
                <div class="col-md-9">
                    <h1 class="account-name" id="user-name"></h1>
                    <div class="container-fluid ps-0">
                        <div class="row ps-0">
                            <div class="col-md-4">
                                <p id="followers" class="information-num">Followers</p>
                            </div>
                            <div class="col-md-4 ps-0">
                                <p id="ratings" class="information-num">Ratings</p>
                            </div>
                            <div class="col-md-4 ps-0">
                                <p id="points" class="information-num">Points</p>
                            </div>
                        </div>
                    </div>
                    <a href="logout" class="btn btn-danger" style="margin-top: 20px; padding: 10px 20px; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        const userId = <?php echo $_SESSION['user_id']; ?>;

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