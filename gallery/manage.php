<?php
session_start();
if ($_SESSION["role"] !== "admin") { header("Location: ../login.php"); exit; }
require_once "../includes/db.php";

$stmt = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
$gallery = $stmt->fetchAll();
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-6xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Manage Gallery</h2>
        <a href="upload.php" class="bg-blue-600 text-white px-4 py-2 rounded">Upload Image</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <?php foreach ($gallery as $item): ?>
            <div class="bg-white rounded shadow p-4 text-center">
                <img src="../<?= $item['image_url'] ?>" class="w-full h-48 object-cover rounded mb-2">
                <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($item['caption']) ?></p>
                <a href="delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Delete this image?')" class="text-red-600">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include "../includes/footer.php"; ?>