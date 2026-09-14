<?php
// PHP 8.1+ makes mysqli throw exceptions by default; switch back to the
// classic connect_error check below so a connection failure shows a clear
// message instead of an unhandled exception (blank page / 500 error).
mysqli_report(MYSQLI_REPORT_OFF);

$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurant_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . ". Make sure MySQL is running and you've imported database.sql (see README.md).");
}
?>