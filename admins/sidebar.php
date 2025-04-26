
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
    transition: 0.3s;
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

/* Toggle Button */
.toggle-btn {
    position: fixed;
    top: 15px;
    left: 15px;
    background-color: rgb(55, 150, 139);
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    z-index: 1100;
    border-radius: 5px;
    transition: left 0.3s ease-in-out;
}

.sidebar.open + .toggle-btn {
    left: 260px;
}


@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }
    .content.shifted {
        margin-left: 200px;
    }
    .sidebar.open + .toggle-btn {
        left: 210px;
    }
}
</style>

<button class="toggle-btn" id="menuButton" onclick="toggleSidebar()">☰ Menu</button>


<div class="sidebar" id="sidebar">
    <a href="home.php">Home</a>
    <a href="profile.php">Profile</a>
    <a href="reports.php">Reports</a>
    <a href="orgstruct.php">Organizational Structure</a>
</div>

<script>
function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let content = document.getElementById("content");

    sidebar.classList.toggle("open");
    content.classList.toggle("shifted");
}
</script>
