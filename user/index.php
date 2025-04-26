<?php
include "layout/header.php";
?>

<style>
/* Full-screen Carousel Background */
.carousel-container {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.carousel-inner img {
    width: 100%;
    height: 100vh;
    object-fit: cover;
}

/* Overlay to enhance readability */
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Dark overlay for contrast */
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

/* Button Styles */
.btn-custom {
    padding: 15px 30px;
    font-size: 20px;
    font-weight: bold;
    border-radius: 10px;
    margin: 10px;
    transition: 0.3s ease-in-out;
    width: 250px;
}

.btn-emergency {
    background-color: #dc3545; /* Red color */
    color: white;
    border: 2px solid #dc3545;
}

.btn-emergency:hover {
    background-color: white;
    color: #dc3545;
    border: 2px solid #dc3545;
}

.btn-non-emergency {
    background-color: #007bff; /* Blue color */
    color: white;
    border: 2px solid #007bff;
}

.btn-non-emergency:hover {
    background-color: white;
    color: #007bff;
    border: 2px solid #007bff;
}
</style>

<!-- Carousel Section -->
<div id="backgroundCarousel" class="carousel slide carousel-container" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./images/church.jpg" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
            <img src="./images/hall.jpg" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
            <img src="./images/seal.jpg" class="d-block w-100" alt="">
        </div>
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#backgroundCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#backgroundCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <!-- Overlay with Buttons -->
    <div class="overlay">
        <h1 class="text-white mb-4">What to Report?</h1>
        <div>
            <a href="emergency.php" class="btn btn-custom btn-emergency">Emergency</a>
            <a href="non-emergency.php" class="btn btn-custom btn-non-emergency">Non-Emergency</a>
        </div>
    </div>
</div>

<?php
include "layout/footer.php";
?>
