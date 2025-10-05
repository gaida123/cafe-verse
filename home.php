<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CafeHome</title>
    <?php
    require_once "header.php";
    ?>
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
                <div class="col-12 col-md-4 mb-3">
                    <div id="todays-pick-container"></div>
                </div>
                <div class="col-12 col-md-8 mb-3">
                    <div class="card content-card">
                        <div class="card-body">
                            <h3 class="card-title">Recent Reviews</h3>
                            <div id="recent-reviews" class="reviews-container"></div>
                        </div>
                    </div>
                    <div class="card content-card">
                        <div class="card-body">
                            <h3 class="card-title" style="color: #5F4024;">Cafes to Try Next</h3>
                            <div class="container-fluid px-0">
                                <div class="row align-items-center mb-3">
                                    <div id="cafes-to-try" class="row align-items-center mb-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cafes = JSON.parse(localStorage.getItem('local_cafes')) || [];
        console.log(cafes);
        const container = document.getElementById('todays-pick-container');
        const today = new Date();
        const seed = today.getFullYear() * 10000 + (today.getMonth() + 1) * 100 + today.getDate();
        const randomNumber = (seed % 20) + 1;

        // currently being picked from the first of the list of nearby cafes
        if (cafes.length > 0) {
            const cafe = cafes[randomNumber];
            const reviews = [];
            let cafeImage = reviews[0]?.photo_url || 'img/cafe-placeholder.jpg';

            container.innerHTML = `
    <div class="card content-card todays-pick-col">
        <h3 class="text-center mt-2 mb-0">Today's Pick</h3>
        <h2 class="text-center mb-0">
            <a href="cafe-info.php?cafe_id=${cafe.id}" class="text-decoration-none" style="color:#5F4024;">
                ${cafe.name}
            </a>
        </h2>
        <p class="text-center mt-0 mb-0">
            <a href="cafe-info.php?cafe_id=${cafe.id}" class="text-decoration-none" style="color:#5F4024;">
                <img src="img/brown-pin-point.svg" alt="" style="width:16px; height:16px; margin-right:5px;">
                ${cafe.address}
            </a>
        </p>
        <div class="card-body d-flex flex-column align-items-center">
            <div class="img-container d-flex justify-content-center" style="width: 100%; height: 0; padding-bottom: 100%; position: relative; overflow: hidden;">
                <img src="${cafeImage}" class="img-fluid" style="object-fit: cover; position: absolute; top: 0; left: 0; width: 100%; height: 100%;" alt="Cafe Image">
                <div class="overlay">
                    <img src="img/fire-logo.svg" alt="fire" class="fire-icon">
                    <span class="vote-count">3</span>
                </div>
            </div>
            <a class="btn btn-interact text-center" href="review-form?cafe_id=${cafe.id}">Review Now</a>
        </div>
    </div>
  `;
        }

        const cafeIds = cafes.map(c => c.id).join(',');
        const limit = 3;
        // Fetch recent reviews
        fetch(`get-recent-reviews.php?cafe_ids=${cafeIds}&limit=${limit}`)
            .then(res => res.json())
            .then(reviews => {
                const container = document.getElementById('recent-reviews');
                container.innerHTML = '';

                if (reviews.length === 0) {
                    container.innerHTML = '<p>No reviews yet.</p>';
                    return;
                }

                reviews.forEach(r => {
                    const cafe = cafes.find(c => c.id == r.cafe_id);
                    const div = document.createElement('a'); // changed to anchor
                    div.href = `review-view.php?review_id=${r.id}`;
                    div.classList.add('d-flex', 'align-items-center', 'mb-3', 'text-decoration-none', 'text-dark');

                    div.innerHTML = `
                <img src="img/profile-logo-brown.svg" alt="User Photo" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                <div class="flex-grow-1">
                    <div class="fw-bold">${r.user_name}</div>
                    <div class="text-muted">${cafe?.name || ''}</div>
                </div>
                <span>${r.title}</span>
            `;

                    container.appendChild(div);
                });
            })
            .catch(err => console.error(err));

        const lat = localStorage.getItem('user_lat');
        const lng = localStorage.getItem('user_lng');

        fetch(`get-random-cafes.php?lat=${lat}&lng=${lng}`)
            .then(res => res.json())
            .then(cafes => {
                const container = document.getElementById('cafes-to-try');
                container.innerHTML = ''; // clear placeholders

                cafes.forEach(cafe => {
                    const div = document.createElement('div');
                    div.classList.add('col-md-4', 'text-center', 'mb-3');

                    // Wrap content in an anchor tag linking to cafe-info.php
                    div.innerHTML = `
                <a href="cafe-info.php?cafe_id=${cafe.id}" class="text-decoration-none">
                    <img src="${cafe.photo_url || 'img/cafe-placeholder.jpg'}" 
                         alt="${cafe.name}" 
                         class="img-fluid" style="border-radius:12px;">
                    <p style="color: #5F4024; font-size: 20px; margin-top:5px;">${cafe.name}</p>
                </a>
            `;
                    container.appendChild(div);
                });
            })
            .catch(err => console.error('Failed to load cafes:', err));
    </script>
</body>

</html>