<?php
session_start(); // Ensure session starts at the beginning
include "header.php";

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION["email"])) {
    header("location: ./login.php");
    exit;
}
?>

<style>
.sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: -250px;
    background-color: #343a40;
    padding-top: 60px;
    transition: left 0.3s ease-in-out;
    z-index: 1000;
}

.sidebar a {
    padding: 15px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
    transition: background 0.3s;
}

.sidebar a:hover {
    background-color: #495057;
}

.sidebar.open {
    left: 0;
}

.content {
    transition: margin-left 0.3s ease-in-out;
    padding: 20px;
    min-height: 100vh;
}

.content.shifted {
    margin-left: 250px;
}

.toggle-btn {
    position: fixed;
    top: 15px;
    left: 15px;
    background-color: #37968b;
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    z-index: 1100;
    border-radius: 5px;
    transition: left 0.3s ease-in-out;
}

.sidebar.open + .toggle-btn {
    left: 265px;
}

@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }
    .content.shifted {
        margin-left: 0;
    }
    .sidebar.open + .toggle-btn {
        left: 215px;
    }
}
</style>

<button class="toggle-btn" id="menuButton" onclick="toggleSidebar()">☰ Menu</button>

<div class="sidebar" id="sidebar">
    <a href="./home.php">Home</a>
    <a href="./profile.php">Profile</a>
    <a href="./reports.php">Reports</a>
    <a href="./orgstruct.php">Organizational Structure</a>
</div>

<div class="content" id="content">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 mx-auto border shadow p-4 bg-light rounded">
                <div class="d-flex justify-content-between align-items-start">
                    <h2>Profile</h2>
                    <img src="<?= isset($_SESSION["profile_picture"]) ? $_SESSION["profile_picture"] : '/images/profile.jpg'; ?>" 
                         alt="Profile Picture" class="img-fluid rounded-circle border" 
                         style="width: 150px; height: 150px; object-fit: cover; min-width: 150px;">
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Firstname</div>
                    <div class="col-sm-8"> <?= $_SESSION["first_name"] ?? "N/A" ?> </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Lastname</div>
                    <div class="col-sm-8"> <?= $_SESSION["last_name"] ?? "N/A" ?> </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Email</div>
                    <div class="col-sm-8"> <?= $_SESSION["email"] ?? "N/A" ?> </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Phone</div>
                    <div class="col-sm-8"> <?= $_SESSION["phone"] ?? "N/A" ?> </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Address</div>
                    <div class="col-sm-8"> <?= $_SESSION["address"] ?? "N/A" ?> </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Registered At</div>
                    <div class="col-sm-8"> <?= $_SESSION["created_at"] ?? "N/A" ?> </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let content = document.getElementById("content");
    let menuButton = document.getElementById("menuButton");

    sidebar.classList.toggle("open");
    content.classList.toggle("shifted");
}
</script>

<?php include "./footer.php"; ?>
