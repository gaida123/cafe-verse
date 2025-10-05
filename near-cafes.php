<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafes Near Me | CafeVerse</title>
    <?php require_once "header.php"; ?>

    <style>
        .cafes-wrapper {
            max-width: 900px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .cafes-title {
            text-align: center;
            color: #fff;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .cafes-subtext {
            text-align: center;
            color: #9B7E67;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .cafes-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .cafe-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(95, 64, 36, 0.08);
            padding: 18px 20px;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .cafe-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(95, 64, 36, 0.15);
        }

        .cafe-name {
            color: #5F4024;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 6px;
        }

        .cafe-address {
            font-size: 14px;
            color: #9B7E67;
            line-height: 1.4;
        }

        .no-cafes {
            text-align: center;
            color: #5F4024;
            font-size: 16px;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <?php require_once "menu.php"; ?>

    <div class="cafes-wrapper">
        <h3 class="cafes-title">Cafés Near You</h3>
        <p class="cafes-subtext">All the cafés you saved are listed below!</p>

        <div class="cafes-list" id="cafes-list">
            <!-- Café cards will be injected here -->
        </div>
    </div>

    <script>
        const cafes = JSON.parse(localStorage.getItem("local_cafes"));
        const listContainer = document.getElementById("cafes-list");

        if (cafes && cafes.length > 0) {
            cafes.forEach(cafe => {
                const card = document.createElement("div");
                card.className = "cafe-card";
                card.innerHTML = `
                    <div class="cafe-name">${cafe.name}</div>
                    <div class="cafe-address">${cafe.address}</div>
                `;
                listContainer.appendChild(card);
            });
        } else {
            listContainer.innerHTML = `<p class="no-cafes">No cafés saved yet.</p>`;
        }
    </script>
</body>

</html>
