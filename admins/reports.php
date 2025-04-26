<?php 
session_start();
include "./header.php"; 
include "./sidebar.php"; 
?>

<div class="content" id="content">
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
                    <th>Actions</th> <!-- New column -->
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "dotproject");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, form_type, lastname, firstname, contact, address, report, message, created_at FROM reports ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) :
                    while ($row = $result->fetch_assoc()) :
                ?>
                        <tr class="<?= $row['form_type'] === 'emergency' ? 'emergency' : 'non-emergency' ?>">
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars(ucfirst($row['form_type'])) ?></td>
                            <td><?= htmlspecialchars($row['lastname']) ?></td>
                            <td><?= htmlspecialchars($row['firstname']) ?></td>
                            <td><?= htmlspecialchars($row['contact']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?= htmlspecialchars($row['report'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($row['message']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="edit_report.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete_report.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this report?');">Delete</a>
                                </div>
                            </td>
                        </tr>
                <?php
                    endwhile;
                else :
                ?>
                    <tr>
                        <td colspan="10" class="text-center">No reports found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $conn->close(); ?>
<?php include "./footer.php"; ?>
