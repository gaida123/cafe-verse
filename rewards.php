<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards</title>
    <?php
    require_once "header.php";
    ?>
</head>

<body>
    <div class="card mt-4 p-3 text-center" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h4 class="mb-2" style="color: #5F4024;">🎁 Redeem Your Points</h4>
        <p class="text-muted mb-3">Collect points by writing reviews. Redeem them for free coffee and rewards at partner cafés!</p>

        <div style="font-size: 22px; font-weight: bold; color: #5F4024;">
            Your Points: <span id="user-points">0</span>
        </div>

        <button id="redeem-btn" class="btn btn-brown mt-3" style="
        background-color: #5F4024;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
    ">Redeem Points</button>

        <p id="redeem-message" class="mt-3 text-muted" style="display:none;"></p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const userPoints = 12;
            document.getElementById("user-points").innerText = userPoints;

            document.getElementById("redeem-btn").addEventListener("click", function() {
                const msg = document.getElementById("redeem-message");
                msg.style.display = "block";

                if (userPoints < 10) {
                    msg.innerHTML = "⚠️ You need at least <b>10 points</b> to redeem rewards!";
                } else {
                    msg.innerHTML = `
                ✅ <b>Partner Café Verification Coming Soon!</b><br>
                You currently have ${userPoints} points. 
                You'll be able to redeem them for rewards once our partner program launches.
            `;
                }
            });
        });
    </script>
</body>

</html>