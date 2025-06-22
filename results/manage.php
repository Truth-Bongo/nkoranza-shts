<?php
session_start();
if ($_SESSION["role"] !== "admin") { header("Location: ../login.php"); exit; }
require_once "../includes/db.php";

$stmt = $conn->prepare("SELECT * FROM results ORDER BY year DESC, term");
$stmt->execute();
$results = $stmt->fetchAll();
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Manage Results</h2>
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100">
                <th>ID</th><th>Student ID</th><th>Year</th><th>Term</th><th>Subject</th><th>Score</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $r): ?>
                <tr class="border-t text-sm text-gray-700">
                    <td class="p-2"><?= $r["id"] ?></td>
                    <td><?= $r["student_id"] ?></td>
                    <td><?= $r["year"] ?></td>
                    <td><?= $r["term"] ?></td>
                    <td><?= $r["subject"] ?></td>
                    <td><?= $r["score"] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $r["id"] ?>" class="text-blue-600 mr-2">Edit</a>
                        <a href="delete.php?id=<?= $r["id"] ?>" onclick="return confirm('Delete this result?');" class="text-red-600">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include "../includes/footer.php"; ?>