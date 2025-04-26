<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$authenticated = isset($_SESSION["email"]);
?>

<!doctype html>
<html lang="en">
<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COMMUNITY CARE</title>
    <link rel="icon" href="../admins/img/seal.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        .logout-link {
            border-radius: 8px; 
            transition: background-color 0.3s ease, border-radius 0.3s ease;
        }

        .logout-link:hover {
            background-color: red !important;
            color: white !important;
            border-radius: 12px; 
        }

        /* Center brand text */
        .navbar .container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .navbar .navbar-brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .navbar .ms-auto {
            margin-left: auto !important;
            z-index: 1;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="">
            <img src="../admins/img/seal.png" width="40" height="40" class="d-inline-block align-top me-2" alt=""> 
            MASLOG CARE
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <?php if ($authenticated) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" role="button" data-bs-toggle="dropdown" 
                            aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item logout-link" href="./logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="./register.php" class="btn btn-primary me-2">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="./login.php" class="btn btn-outline-primary">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-zorblLskP56XyGdMQ7U6Lzd/xJ+1l7kM9Lk9Q2wFqBi5DqT0sbP8J+8p5fBY02W9" crossorigin="anonymous"></script>
</body>
</html>
