<?php
session_start();

// Use correct MySQL credentials
$conn = new mysqli("localhost", "root", "", "dotproject");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_type = $_POST['form_type'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $report = isset($_POST['report']) ? $_POST['report'] : NULL;

    $stmt = $conn->prepare("INSERT INTO reports (form_type, lastname, firstname, contact, address, report, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $form_type, $lastname, $firstname, $contact, $address, $report, $message);

    if ($stmt->execute()) {
        $_SESSION['form_submitted'] = true;
        $_SESSION['form_type'] = $form_type;
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
