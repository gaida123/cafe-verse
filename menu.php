<?php
session_start();
?>
<div class="menu mb-5">
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" data-bs-toggle="offcanvas" href="#menuCanvas" aria-controls="menuCanvas" role="button">
                <img src="img/hamburger.svg" alt="menu-icon" width="30" height="24">
            </a>
            <a href="/" class="brand-logo-centered">
                <img src="img/logo-no-slogan.svg" width="250px" alt="logo">
            </a>
            <?php
            if (isset($_SESSION["user_id"])) {
            ?>
                <div class="points-counter d-md-block d-none">
                    <img src="img/bean-logo.svg" alt="icon" style="width: 50px; height: 50px; margin-right: 5px;">
                    <span id="points-count">0</span>
                </div>
            <?php
            }
            ?>
        </div>
    </nav>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="menuCanvas" aria-labelledby="menuCanvasLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="margin: 0;">
            </button>
        </div>
        <div class="offcanvas-body">
            <ul class="menu-links">
                <li><a href="/home">Home</a></li>
                <li><a href="review">Review</a></li>
                <li><a href="/home#todays-pick">Today's Pick</a></li>
                <li><a href="/rewards">Rewards</a></li>
                <li><a href="/discounts">Discounts</a></li>
                <li><a href="/about">About</a></li>
            </ul>
        </div>
        <div class="offcanvas-footer" style="padding: 1rem 1rem;">
            <ul class="menu-links">
                <li>
                    <a href="/profile">
                        <img src="img/profile-logo-brown.svg" width="30" height="30" alt="">
                        Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Fetch the points on page load
    window.onload = function() {
        fetchPoints();
    };

    const userId = <?php echo $_SESSION['user_id']; ?>;

    function fetchPoints() {
        fetch(`get-user-profile.php?user_id=${userId}`)
            .then(response => response.json())
            .then(data => {                
                if (data.user.points) {
                    document.getElementById('points-count').innerText = data.user.points;
                } else {
                    console.error("Error fetching points:", data.error);
                }
            })
            .catch(error => {
                console.error('Error fetching points:', error);
            });
    }
</script>