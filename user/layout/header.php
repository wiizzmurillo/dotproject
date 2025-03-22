<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BARANGAY MASLOG DIGITAL ASSISTANT</title>
    <link rel="icon" href="/images/a.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            padding-top: 70px; /* Prevents content from being hidden behind the navbar */
        }
        .navbar {
            background-color: #000; /* Ensures the background fills the navbar */
            padding: 10px 0;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar img {
            height: 40px; /* Ensures the logo is correctly sized */
        }
        .clock {
            color: #fff;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="index.php">
            <img src="/images/z.jpg" width="40" height="40" class="rounded-circle" alt="Barangay Seal">
            <span class="fw-bold text-white">BARANGAY MASLOG DIGITAL ASSISTANT</span>
        </a>
        <div id="clock" class="clock"></div> <!-- Real-time clock -->
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Real-time Clock Script -->
<script>
    function updateClock() {
        const options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
        document.getElementById('clock').innerText = new Date().toLocaleTimeString('en-US', options);
    }
    setInterval(updateClock, 1000); // Update every second
    updateClock(); // Initial call to display immediately
</script>

</body>
</html>
