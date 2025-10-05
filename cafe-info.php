<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Name | Reviews | CafeVerse</title>
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
    <div class="home-page" style="height: 100%;" id="cafe-page-container">
        <div class="container" id="cafe-content">
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <div class="card content-card todays-pick-col">
                        <div class="card-body d-flex flex-column align-items-start">
                            <div class="img-container" style="width: 100%; padding-bottom: 100%; position: relative; overflow: hidden; margin-bottom: 5px;">
                                <img id="cafe-img" src="img/cafe-placeholder.jpg" class="img-fluid"
                                    style="object-fit: cover; position: absolute; top: 0; left: 0; width: 100%; height: 100%;" alt="Cafe Image">
                            </div>

                            <h3 id="cafe-name" class="mt-2 mb-1" style="color: #5F4024;">Cafe Name</h3>

                            <p id="cafe-address" class="mb-2 d-flex align-items-center" style="color: #5F4024;">
                                <img src="img/brown-pin-point.svg" alt="Pin" style="width:16px; height:16px; margin-right:6px;">
                                Address Here
                            </p>

                            <div class="mb-2">
                                <span id="cafe-rating" style="color: #FFD700; font-size: 1.2rem;">★ ★ ★ ★ ☆</span>
                            </div>

                            <button class="btn btn-interact w-100" onclick="openReview()">
                                Leave a Review?
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 mb-3">
                    <div class="card content-card">
                        <div class="card-body">
                            <h3 class="card-title mb-3">Recent Reviews</h3>
                            <div id="recent-reviews" class="d-flex flex-column gap-3" style="max-height: 500px; overflow-y: auto;"></div>
                            <div class="d-flex justify-content-between mt-2">
                                <button id="prev-page" class="btn btn-sm btn-outline-secondary">Previous</button>
                                <span id="page-info" class="text-muted"></span>
                                <button id="next-page" class="btn btn-sm btn-outline-secondary">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="cafe-not-found" style="display:none;">
        <div class="text-center mt-5">
            <h3 style="color:white;">Cafe not found</h3>
            <p class="text-light">We couldn't find the cafe you were looking for. Please check the link or try searching for another cafe.</p>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const cafeId = urlParams.get('cafe_id');

        const cafeContainer = document.getElementById('cafe-page-container');
        const notFoundContainer = document.getElementById('cafe-not-found');
        const reviewsPerPage = 5; // Set how many reviews per page
        let currentPage = 1; // Initialize the current page

        function openReview() {
            window.location.href = "review-form?cafe_id=" + cafeId
        }

        async function loadCafeInfo() {
            if (!cafeId) {
                // No cafe_id in URL
                cafeContainer.style.display = 'none';
                notFoundContainer.style.display = 'block';
                return;
            }

            try {
                const res = await fetch(`get-cafe-info.php?cafe_id=${cafeId}`);
                if (!res.ok) throw new Error('Network error');

                const cafe = await res.json();

                if (!cafe || !cafe.id) {
                    // Invalid cafe
                    cafeContainer.style.display = 'none';
                    notFoundContainer.style.display = 'block';
                    return;
                }

                // Show content
                cafeContainer.style.display = 'block';
                notFoundContainer.style.display = 'none';

                // Update DOM
                document.getElementById('cafe-img').src = cafe.photo_url || 'img/cafe-placeholder.jpg';
                document.getElementById('cafe-name').textContent = cafe.name;
                document.getElementById('cafe-address').innerHTML = `<img src="img/brown-pin-point.svg" alt="Pin" style="width:16px; height:16px; margin-right:6px;"> ${cafe.address}`;

                const stars = Math.round(cafe.overall_rating || 0);
                const starString = '★'.repeat(stars) + '☆'.repeat(5 - stars);
                document.getElementById('cafe-rating').textContent = starString;

            } catch (err) {
                console.error(err);
                cafeContainer.style.display = 'none';
                notFoundContainer.style.display = 'block';
            }
        }

        // Load reviews for the current page
        async function loadRecentReviews(page = 1) {
            if (!cafeId) return;

            const res = await fetch(`get-reviews.php?cafe_id=${cafeId}`);
            const allReviews = await res.json();
            const container = document.getElementById("recent-reviews");
            container.innerHTML = "";

            const startIndex = (page - 1) * reviewsPerPage;
            const pageReviews = allReviews.slice(startIndex, startIndex + reviewsPerPage);

            pageReviews.forEach(r => {
                const shortComment = r.comment.length > 100 ? r.comment.slice(0, 100) + "..." : r.comment;
                const div = document.createElement("a");
                div.href = `review-view.php?review_id=${r.id}`;
                div.classList.add("d-flex", "align-items-start", "gap-3", "border-bottom", "pb-2", "text-decoration-none", "text-dark");

                div.innerHTML = `
                    <img src="img/profile-logo-brown.svg" alt="User Photo" class="rounded-circle" style="width:50px; height:50px; object-fit:cover;">
                    <div class="flex-grow-1">
                        <div class="fw-bold">${r.user_name}</div>
                        <div class="text-muted" style="font-size:0.9rem;">${r.cafe_name || ''}</div>
                        <div class="text-truncate" style="font-size:0.95rem; max-width:100%;">${shortComment}</div>
                        <div class="text-muted" style="font-size:0.8rem;">${new Date(r.created_at).toLocaleDateString()}</div>
                        <div class="text-warning" style="font-size:1rem;">${"★".repeat(r.rating) + "☆".repeat(5 - r.rating)}</div>
                    </div>
                `;
                container.appendChild(div);
            });

            const totalPages = Math.ceil(allReviews.length / reviewsPerPage);
            document.getElementById("prev-page").disabled = currentPage === 1;
            document.getElementById("next-page").disabled = currentPage === totalPages;
            document.getElementById("page-info").textContent = `Page ${currentPage} of ${totalPages}`;
        }

        // Page navigation functions
        document.getElementById("prev-page").addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                loadRecentReviews(currentPage);
            }
        });

        document.getElementById("next-page").addEventListener("click", () => {
            currentPage++;
            loadRecentReviews(currentPage);
        });

        // Run
        loadCafeInfo().then(() => loadRecentReviews(currentPage));
    </script>
</body>

</html>