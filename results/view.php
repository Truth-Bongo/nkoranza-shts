<?php
session_start();
require_once "../includes/db.php";

$role = $_SESSION["role"];
if (!in_array($role, ['student', 'parent'])) {
    header("Location: ../login.php");
    exit;
}

$student_id = ($role === "student") ? $_SESSION["user_id"] : $_SESSION["student_id"];
$stmt = $conn->prepare("SELECT * FROM results WHERE student_id = ? ORDER BY year DESC, term ASC");
$stmt->execute([$student_id]);
$results = $stmt->fetchAll();
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Academic Results</h2>
    <a href="generate_pdf.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">Download PDF</a>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Year</th><th>Term</th><th>Subject</th><th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $r): ?>
                <tr class="border-t">
                    <td class="p-2"><?= $r["year"] ?></td>
                    <td><?= $r["term"] ?></td>
                    <td><?= $r["subject"] ?></td>
                    <td><?= $r["score"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include "../includes/footer.php"; ?>