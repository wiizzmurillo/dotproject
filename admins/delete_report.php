<?php
session_start();
include "db.php";

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

// Validate the report ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: report.php");
    exit;
}

$report_id = (int)$_GET['id'];  // Cast to integer for safety
$user_id = $_SESSION['id'];

$db = getDatabaseConnection();

// Only allow delete if user owns the report
$stmt = $db->prepare("DELETE FROM reports WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $report_id, $user_id);

if ($stmt->execute()) {
    header("Location: report.php?deleted=1");
    exit;
} else {
    // Redirect back to reports page with error message if delete fails
    header("Location: report.php?error=1");
    exit;
}
?>
