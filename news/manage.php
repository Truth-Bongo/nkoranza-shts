<?php
session_start();
if ($_SESSION["role"] !== "admin") exit;
require_once "../includes/db.php";

$stmt = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
$newsList = $stmt->fetchAll();
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-6xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Manage News</h2>
        <a href="add.php" class="bg-blue-600 text-white px-4 py-2 rounded">Add News</a>
    </div>
    <table class="w-full bg-white shadow rounded">
        <thead><tr><th>Title</th><th>Category</th><th>Actions</th></tr></thead>
        <tbody>
            <?php foreach ($newsList as $news): ?>
            <tr class="border-t">
                <td class="p-2"><?= $news["title"] ?></td>
                <td><?= $news["category"] ?></td>
                <td>
                    <a href="edit.php?id=<?= $news["id"] ?>" class="text-blue-600 mr-2">Edit</a>
                    <a href="delete.php?id=<?= $news["id"] ?>" class="text-red-600" onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include "../includes/footer.php"; ?>
