<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: home");
    exit();
}
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT id, username, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location: ../index");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php
    require_once "header.php";
    ?>
    <style>
        a {
            color: white;
        }

        a:hover {
            color: #F2E8D7;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-12 col-md-6 col-lg-4 mx-auto">
                <img src="img/logo-no-slogan.svg" alt="">
                <div class="card p-4" style="background-color: transparent; border: none;">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-interact w-100">Login</button>
                    </form>
                    <p style="color: white;">
                        Don't have an account? <a href="/register" class="text-decoration-none">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>