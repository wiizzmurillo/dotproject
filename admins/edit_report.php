<?php
session_start();
include "header.php";
include "db.php";

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

$db = getDatabaseConnection();

// Validate report ID
$report_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$report_id) {
    $error = "Invalid report ID.";
} else {
    $user_id = $_SESSION['id'];
    $error = "";
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);

        // Validate inputs
        if (empty($title) || empty($description)) {
            $error = "Both title and description are required.";
        } else {
            // Sanitize inputs
            $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');

            // Prepare the update statement
            $stmt = $db->prepare("UPDATE reports SET title = ?, description = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ssii", $title, $description, $report_id, $user_id);
            if ($stmt->execute()) {
                $success = "Report updated successfully.";
            } else {
                $error = "Failed to update report.";
            }
            $stmt->close();
        }
    } else {
        // Fetch the existing report data
        $stmt = $db->prepare("SELECT title, description FROM reports WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $report_id, $user_id);
        $stmt->execute();
        $stmt->bind_result($title, $description);
        if (!$stmt->fetch()) {
            $error = "Report not found or unauthorized access.";
        }
        $stmt->close();
    }
}

?>

<div class="container py-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center">Edit Report</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if (!$success): ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input class="form-control" name="title" value="<?= htmlspecialchars($title) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4" required><?= htmlspecialchars($description) ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="report.php" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Report</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include "footer.php"; ?>
