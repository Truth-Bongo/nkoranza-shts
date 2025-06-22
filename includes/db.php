<?php
$host = "localhost";      // For XAMPP or most local setups
$dbname = "nkshs_db";     // Use the actual DB name
$username = "root";       // Default for XAMPP
$password = "";           // Leave empty for XAMPP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Enable error reporting
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
