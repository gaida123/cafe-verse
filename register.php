<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: home");
    exit();
}
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["user_id"] = mysqli_insert_id($conn);
        $_SESSION["username"] = $username;
        $_SESSION["name"] = $name; // Save the name to session as well
        header("Location: ../index");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-interact w-100">Register</button>
                    </form>
                    <p style="color: white;">
                        Already have an account? <a href="/login" class="text-decoration-none">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
