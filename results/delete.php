<?php
session_start();
if ($_SESSION["role"] !== "admin") { header("Location: ../login.php"); exit; }
require_once "../includes/db.php";

$id = $_GET["id"];
$stmt = $conn->prepare("DELETE FROM results WHERE id = ?");
$stmt->execute([$id]);

header("Location: manage.php");
exit;
?>