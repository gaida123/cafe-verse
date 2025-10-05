<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Review | CafeVerse</title>
    <?php require_once "header.php"; ?>
    <style>
        .left-card img {
            width: 100%;
            border-radius: 12px;
        }

        .star-rating,
        .rating {
            color: #FFD700;
            font-size: 1rem;
        }

        .rating-bar {
            background: #D9C7B0;
            height: 6px;
            border-radius: 3px;
            margin-bottom: 10px;
            position: relative;
        }

        .rating-bar-fill {
            height: 6px;
            border-radius: 3px;
            background: #5F4024;
            position: absolute;
            top: 0;
            left: 0;
        }

        .gallery {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .gallery-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        #like-btn {
            background-color: #5F4024;
            border: none;
            color: #F5EBDD;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        #like-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-exit {
            background-color: #5F4024;
            color: #F5EBDD;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            margin-top: 15px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php require_once "menu.php"; ?>

    <div class="container" id="reviews">
        <div class="row g-4">
            <!-- Left Card: Cafe Info -->
            <div class="col-lg-4">
                <div class="card content-card left-card">
                    <div class="card-body">
                        <img id="cafe-photo" src="img/cafe-placeholder.jpg" alt="Cafe Photo">
                        <h3 class="mt-2 mb-1" id="cafe-name">Cafe Name</h3>
                        <p>Rating:</p>
                        <div class="rating" id="cafe-rating-display">
                            <span class="star">&#9733;</span>
                            <span class="star">&#9733;</span>
                            <span class="star">&#9733;</span>
                            <span class="star">&#9733;</span>
                            <span class="star">&#9733;</span>
                        </div>
                        <div class="text-muted mb-3" id="cafe-address">Address</div>
                        <div>Coffee
                            <div class="rating-bar">
                                <div class="rating-bar-fill" id="coffee-rating" style="width:60%;"></div>
                            </div>
                        </div>
                        <div>Ambience
                            <div class="rating-bar">
                                <div class="rating-bar-fill" id="ambience-rating" style="width:60%;"></div>
                            </div>
                        </div>
                        <div>Cleanliness
                            <div class="rating-bar">
                                <div class="rating-bar-fill" id="cleanliness-rating" style="width:60%;"></div>
                            </div>
                        </div>
                        <div>Vibes
                            <div class="rating-bar">
                                <div class="rating-bar-fill" id="vibes-rating" style="width:60%;"></div>
                            </div>
                        </div>
                        <button class="btn-exit" onclick="window.history.back()">Exit Review</button>
                    </div>
                </div>
            </div>

            <!-- Right Card: Review Info -->
            <div class="col-lg-8">
                <div class="card content-card right-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <img id="user-photo" src="img/profile-logo-brown.svg" style="width:50px;height:50px;border-radius:50%;object-fit:cover;">
                                <div>
                                    <div class="fw-bold" id="user-name">User Name</div>
                                    <div class="text-muted" style="font-size:0.85rem;" id="user-email">user@example.com</div>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-2" id="review-title">Review Title</h4>
                        <p style="text-align: justify;" id="review-comment">Review comment...</p>
                        <div class="gallery mt-3 mb-3" id="review-gallery"></div>
                        <button id="like-btn" data-review-id="">Like <span id="like-count">0</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const reviewId = urlParams.get('review_id'); // get review ID from URL

        async function loadReviewPage() {
            const container = document.getElementById("reviews");

            const res = await fetch(`get-review-data.php?review_id=${reviewId}`);
            const data = await res.json();

            if (!data.success) {
                container.innerHTML = "<p class='text-center' style='font-size:30px'>Review not found.</p>";
                return;
            }

            const review = data.review;
            const cafe = data.cafe;
            const user = data.user;

            // Render gallery
            const galleryHTML = (review.images || []).map(img => `<div class="gallery-item"><img src="${img}" alt=""></div>`).join("");

            document.getElementById('cafe-photo').src = cafe.photo_url || 'img/cafe-placeholder.jpg';
            document.getElementById('cafe-name').textContent = cafe.name;
            document.getElementById('cafe-address').textContent = cafe.address;
            const ratingValue = review.rating; // e.g., 4 out of 5
            const stars = document.querySelectorAll('#cafe-rating-display .star');
            stars.forEach((star, index) => {
                if (index < ratingValue) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });


            document.getElementById('coffee-rating').style.width = (review.coffee || 60) + "%";
            document.getElementById('ambience-rating').style.width = (review.ambience || 60) + "%";
            document.getElementById('cleanliness-rating').style.width = (review.cleanliness || 60) + "%";
            document.getElementById('vibes-rating').style.width = (review.vibes || 60) + "%";

            // Right card
            document.getElementById('user-photo').src = user.photo_url || 'img/profile-logo-brown.svg';
            document.getElementById('user-name').textContent = user.name;
            document.getElementById('user-email').textContent = user.email;

            document.getElementById('review-title').textContent = review.title;
            document.getElementById('review-comment').textContent = review.comment;
            document.getElementById('like-btn').setAttribute('data-review-id', review.id);
            document.getElementById('like-count').textContent = review.likes || 0;

            // Render gallery
            const gallery = document.getElementById('review-gallery');
            gallery.innerHTML = (review.images || []).map(img => `<div class="gallery-item"><img src="${img}" alt=""></div>`).join("");

            // Like button logic
            const likeBtn = document.getElementById('like-btn');
            likeBtn.addEventListener('click', async () => {
                const btn = likeBtn;
                const reviewId = btn.getAttribute('data-review-id');
                const countEl = document.getElementById('like-count');
                countEl.textContent = parseInt(countEl.textContent) + 1;
                btn.disabled = true;

                try {
                    const res = await fetch('like-review.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            review_id: reviewId
                        })
                    });
                    const data = await res.json();
                    if (data.success) {
                        countEl.textContent = data.likes;
                    }
                } catch (e) {
                    console.error('Failed to like review:', e);
                }
            });
        }

        loadReviewPage();
    </script>
</body>

</html>