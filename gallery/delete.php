<?php
session_start();
if ($_SESSION["role"] !== "admin") { header("Location: ../login.php"); exit; }
require_once "../includes/db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Get file path
    $stmt = $conn->prepare("SELECT image_url FROM gallery WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();

    // Delete from DB
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->execute([$id]);

    // Delete file
    if ($image && file_exists("../" . $image)) {
        unlink("../" . $image);
    }
}

header("Location: manage.php");
exit;
?>