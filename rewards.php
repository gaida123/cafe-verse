<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards | CafeVerse</title>
    <?php require_once "header.php"; ?>

    <style>
        .rewards-container {
            max-width: 500px;
            margin: 100px auto;
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(95, 64, 36, 0.1);
            text-align: center;
            padding: 30px 25px;
            animation: fadeIn 0.5s ease-in;
        }

        .rewards-title {
            color: #5F4024;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .rewards-subtext {
            color: #9B7E67;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .points-box {
            background-color: #FFF2E5;
            color: #5F4024;
            font-weight: 600;
            font-size: 20px;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
        }

        #redeem-btn {
            background-color: #5F4024;
            color: #fff;
            font-weight: bold;
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        #redeem-btn:hover {
            background-color: #704a2a;
            transform: translateY(-2px);
        }

        #redeem-message {
            margin-top: 20px;
            color: #5F4024;
            font-size: 15px;
            animation: fadeInUp 0.4s ease;
        }

        /* Cute floating icons */
        .floating-icons {
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
        }

        .floating-icons span {
            margin: 0 5px;
            animation: float 2s ease-in-out infinite;
        }

        .floating-icons span:nth-child(2) {
            animation-delay: 0.3s;
        }

        .floating-icons span:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <!-- Include your menu -->
    <?php require_once "menu.php"; ?>

    <div class="rewards-container">
        <h4 class="rewards-title">Redeem Your Points</h4>
        <p class="rewards-subtext">Collect points by writing reviews and enjoy free coffee & rewards at partner cafés!</p>

        <div class="points-box">
            Your Points: <span id="user-points">0</span>
        </div>

        <button id="redeem-btn">Redeem Points</button>

        <p id="redeem-message" style="display:none;"></p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const userPoints = 12;
            const pointsDisplay = document.getElementById("user-points");
            const message = document.getElementById("redeem-message");
            const button = document.getElementById("redeem-btn");

            pointsDisplay.innerText = userPoints;

            button.addEventListener("click", function () {
                message.style.display = "block";

                if (userPoints < 10) {
                    message.innerHTML = "⚠️ You need at least <b>10 points</b> to redeem rewards!";
                } else {
                    message.innerHTML = `
                        ✅ <b>Partner Café Verification Coming Soon!</b><br>
                        You currently have ${userPoints} points.<br>
                        You’ll be able to redeem them for rewards once our partner program launches.
                    `;
                }
            });
        });
    </script>
</body>
</html>
