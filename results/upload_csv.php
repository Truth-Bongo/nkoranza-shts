<?php
session_start();
if ($_SESSION["role"] !== "admin") { header("Location: ../login.php"); exit; }
require_once "../includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csv"])) {
    $file = fopen($_FILES["csv"]["tmp_name"], "r");
    $first = true;
    while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
        if ($first) { $first = false; continue; } // Skip header
        list($student_id, $term, $subject, $score, $year) = $row;
        $stmt = $conn->prepare("INSERT INTO results (student_id, term, subject, score, year) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$student_id, $term, $subject, $score, $year]);
    }
    fclose($file);
    $message = "CSV uploaded successfully!";
}
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Upload Results (CSV)</h2>
    <?php if ($message): ?><p class="text-green-600 mb-4"><?= $message ?></p><?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="csv" accept=".csv" required class="mb-4">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload CSV</button>
    </form>
    <p class="text-sm text-gray-500 mt-2">CSV format: student_id,term,subject,score,year</p>
</div>
<?php include "../includes/footer.php"; ?>