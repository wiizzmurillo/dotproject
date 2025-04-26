<?php
session_start(); // Ensure session starts at the beginning
include "./header.php";
include "./sidebar.php";


if (!isset($_SESSION["email"])) {
    header("location:/login.php");
    exit;
}
?>

<style>
.org-chart {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.org-node {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px;
    border: 2px solid #007bff;
    border-radius: 10px;
    background-color: #f8f9fa;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    width: 200px;
    text-align: center;
    position: relative;
}

.org-node::before {
    content: '';
    position: absolute;
    width: 2px;
    height: 30px;
    background-color: #007bff;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
}

.org-node img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.org-branch {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    max-width: 1000px;
}

.org-branch .org-node::before {
    height: 20px;
}
</style>


<div class="content" id="content">
    <div class="container py-5">
        <h2 class="text-center mb-4">Organizational Structure</h2>
        <div class="org-chart">
            


            <div class="org-node">
                <img src="/images/administration/captain.png" alt="Captain">
                <strong>Captain</strong>
                <p>John Doe</p>
            </div>

            

            <div class="org-branch">
                <?php
                $counselors1 = [
                    ["Jane Smith", "/administration/c1.png"],
                    ["Michael Brown", "/administration/c2.png"],
                    ["Sarah Johnson", "/administration/c3.png"]
                ];
                
                foreach ($counselors1 as $counselor) {
                    echo "<div class='org-node'>
                        <img src='/images/{$counselor[1]}' alt='{$counselor[0]}'>
                        <strong>Counselor</strong>
                        <p>{$counselor[0]}</p>
                    </div>";
                }
                ?>
            </div>

            
            <div class="org-branch">
                <?php
                $counselors2 = [
                    ["David Lee", "/administration/c4.png"],
                    ["Emily Wilson", "/administration/c5.png"],
                    ["James Anderson", "/administration/c6.png"],
                    ["Olivia Martinez", "/administration/c7.png"]
                ];
                
                foreach ($counselors2 as $counselor) {
                    echo "<div class='org-node'>
                        <img src='/images/{$counselor[1]}' alt='{$counselor[0]}'>
                        <strong>Counselor</strong>
                        <p>{$counselor[0]}</p>
                    </div>";
                }
                ?>
            </div>

            
            <div class="org-branch">
                <?php
                $staffs = [
                    ["Chris Evans", "/administration/s1.jpg"],
                    ["Anna Scott", "/administration/s1.jpg"],
                    ["Robert Taylor", "/administration/s1.jpg"],
                    ["Sophia White", "/administration/s1.jpg"]
                ];
                
                foreach ($staffs as $staff) {
                    echo "<div class='org-node'>
                        <img src='/images/{$staff[1]}' alt='{$staff[0]}'>
                        <strong>Staff</strong>
                        <p>{$staff[0]}</p>
                    </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "./footer.php"; ?>
