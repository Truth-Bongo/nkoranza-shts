<?php
session_start();
if ($_SESSION["role"] !== "student") {
    header("Location: ../login.php");
    exit;
}
?>
<?php include "../includes/header.php"; ?>
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-4">Welcome, <?= $_SESSION["name"] ?>!</h2>
    <p class="text-gray-600">You can view your results, download reports, and more here.</p>
</div>
<?php include "../includes/footer.php"; ?>