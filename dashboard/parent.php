<?php
session_start();
if ($_SESSION["role"] !== "parent") {
    header("Location: ../login.php");
    exit;
}
?>
<?php include "../includes/header.php"; ?>
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-4">Welcome, Parent <?= $_SESSION["name"] ?>!</h2>
    <p class="text-gray-600">You can monitor your child’s academic progress here.</p>
</div>
<?php include "../includes/footer.php"; ?>