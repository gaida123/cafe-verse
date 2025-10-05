<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}
$user_id = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <?php
    require_once "header.php";
    ?>
    <style>
        .container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            display: flex;
            gap: 30px;
        }

        .review-form {
            flex: 1;
            padding: 20px;
        }

        .review-form h2 {
            font-size: 24px;
            color: #4E3629;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .review-form label {
            font-size: 16px;
            color: #6F4F37;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .form-select {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background-color: #F8F4E6;
        }

        .btn-primary {
            background-color: #4E3629;
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #6F4F37;
        }

        .cafe-details {
            flex: 0.4;
            padding: 20px;
            background-color: #F8F4E6;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .cafe-image {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .cafe-name {
            font-size: 20px;
            font-weight: bold;
            color: #4E3629;
            text-align: center;
        }

        .alert {
            font-size: 16px;
        }

        #loadingSpinner {
            margin-top: 15px;
        }

        .spinner-border {
            color: #4E3629;
        }

        .form-label {
            font-size: 18px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="cafe-details">
            <img src="img/cafe-placeholder.jpg" alt="Cafe Image" class="cafe-image">
            <div class="cafe-name" id="cafeName"></div>
            <div class="cafe-name" id="cafeName"></div>
        </div>

        <!-- Right side: Review Form -->
        <div class="review-form">
            <h2>Leave a Review</h2>

            <form id="reviewForm" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <input type="hidden" name="cafe_id" value="<?php echo $_GET['cafe_id'] ?? 1; ?>">

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <select name="rating" id="rating" class="form-select" required>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="1">⭐</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Your Review Subject:</label>
                    <input name="title" id="title" class="form-control" placeholder="Subject" required>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Your Review:</label>
                    <textarea name="comment" id="comment" class="form-control" placeholder="Write something..." required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Images: (has to be png, jpg)</label>
                    <input type="file" name="photo_1" class="form-control mb-2" accept="image/*">
                    <input type="file" name="photo_2" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary" id="submitBtn">Submit Review</button>

                <!-- Loading Spinner -->
                <div id="loadingSpinner" class="d-none mt-3 text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <!-- Response Message -->
                <div id="responseMsg" class="mt-3"></div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("reviewForm").addEventListener("submit", async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById("submitBtn");
            submitBtn.disabled = true;
            document.getElementById("loadingSpinner").classList.remove("d-none");

            const formData = new FormData(e.target);

            const res = await fetch("add-review.php", {
                method: "POST",
                body: formData
            });

            const data = await res.json();

            document.getElementById("responseMsg").innerHTML = '';

            if (data.success) {
                document.getElementById("responseMsg").innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your review has been submitted.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                e.target.reset();
            } else {
                document.getElementById("responseMsg").innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }

            submitBtn.disabled = false;
            document.getElementById("loadingSpinner").classList.add("d-none");
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cafeNameElement = document.getElementById("cafeName");
            const cafeImageElement = document.querySelector(".cafe-image");

            fetch(`get-cafe-info.php?cafe_id=${<?php echo $_GET['cafe_id'] ?? 1; ?>}`)
                .then(response =>
                    response.json())
                .then(data => {
                    cafeNameElement.textContent = data.name;
                    cafeImageElement.src = "img/cafe-placeholder.jpg";
                })
                .catch(error => {
                    console.error('Error fetching cafe info:', error);
                    cafeNameElement.textContent = "Error loading cafe info";
                    cafeImageElement.src = "img/cafe-placeholder.jpg";
                });
        });
    </script>
</body>

</html>