<?php
function getDatabaseConnection() {
    $servername = "localhost";  // Your database host
    $username = "root";         // Your database username
    $password = "";             // Your database password (empty for XAMPP)
    $dbname = "dotproject";     // Your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
