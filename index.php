<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CafeHome</title>
    <style>
        /* Basic styling */
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .loading-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Add fade-in animation */
        .fade-in {
            opacity: 0;
            animation: fadeIn 2s forwards;
        }

        /* Define fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Button styling */
        button {
            padding: 12px 30px;
            font-size: 18px;
            background-color: #F2E8D7;
            color: #4E3629;
            border: 2px solid #D1B59A;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.2s ease;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background-color: #D1B59A;
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        button:focus {
            outline: none;
            border-color: #F9E3C7;
            box-shadow: 0 0 8px rgba(245, 229, 169, 0.8);
        }

        button:active {
            transform: translateY(2px);
            background-color: #D1B59A;
        }


        .button-container {
            opacity: 0;
        }
    </style>
    <?php
    require_once "header.php";
    ?>
</head>

<body>
    <div class="loading-page">
        <div class="d-flex align-items-center justify-content-center">
            <div class="container text-center mb-4">
                <img src="img/home-logo.svg" alt="home-logo" class="img-fluid">
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center button-container">
            <button id="find-btn">Click To Find Local Spots</button>
        </div>
    </div>

    <script>
        // Delay the appearance of the button after 2 seconds
        window.onload = () => {
            setTimeout(() => {
                const buttonContainer = document.querySelector('.button-container');
                buttonContainer.classList.add('fade-in');
                buttonContainer.style.opacity = 1;
            }, 500); // Delay of 500ms
        }
    </script>

    <script>
        document.getElementById("find-btn").addEventListener("click", () => {
            if (!navigator.geolocation) {
                alert("Geolocation not supported by your browser.");
                return;
            }

            navigator.geolocation.getCurrentPosition(success, error);
        });

        function success(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            localStorage.setItem('user_lat', lat);
            localStorage.setItem('user_lng', lng);

            // Send to PHP backend
            fetch(`/get-nearby-cafes.php?lat=${lat}&lng=${lng}`)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    localStorage.setItem('local_cafes', JSON.stringify(data));
                    window.location.href = "/home"
                })
                .catch(err => console.error(err));
        }

        function error() {
            alert("Unable to get your location.");
        }
    </script>
</body>

</html>