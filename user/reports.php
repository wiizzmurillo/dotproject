<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "dotproject");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reports from database
$sql = "SELECT id, form_type, lastname, firstname, contact, address, report, message, created_at FROM reports ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php include "layout/header.php"; ?>

<style>
    .container {
        padding-top: 50px;
    }
    .table {
        margin-top: 20px;
    }
    .emergency {
        background-color: #dc3545; /* Red for emergency */
        color: white;
    }
    .non-emergency {
        background-color: #007bff; /* Blue for non-emergency */
        color: white;
    }
</style>

<div class="container">
    <h2 class="mb-4">Submitted Reports</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Report</th>
                <th>Message</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="<?= $row['form_type'] == 'emergency' ? 'emergency' : 'non-emergency' ?>">
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars(ucfirst($row['form_type'])) ?></td>
                        <td><?= htmlspecialchars($row['lastname']) ?></td>
                        <td><?= htmlspecialchars($row['firstname']) ?></td>
                        <td><?= htmlspecialchars($row['contact']) ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td><?= htmlspecialchars($row['report'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['message']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">No reports found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include "layout/footer.php";
?>
