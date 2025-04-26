<?php
session_start();

if (!isset($_SESSION['form_submitted'])) {
    header("Location: index.php");
    exit();
}

// Determine if this was an Emergency or Non-Emergency request
$form_type = $_SESSION['form_type'] ?? 'non-emergency';

// Unset session variables to prevent resubmission on refresh
unset($_SESSION['form_submitted']);
unset($_SESSION['form_type']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .confirmation-container {
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
        }
        .check-icon {
            font-size: 50px;
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="confirmation-container">
    <div class="check-icon">✅</div>
    <h2>Request Submitted</h2>
    <p>Your <strong><?php echo ucfirst($form_type); ?></strong> request has been successfully submitted.</p>
    <a href="index.php" class="btn btn-primary">Submit Another Request</a>
</div>

</body>
</html>
