<?php
session_start();
if ($_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit;
}
?>
<?php include "../includes/header.php"; ?>
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-4">Welcome, Admin <?= $_SESSION["name"] ?>!</h2>
    <p class="text-gray-600">Use the sidebar to manage students, results, news, and more.</p>
</div>
<?php include "../includes/footer.php"; ?>