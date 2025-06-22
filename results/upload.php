<?php
session_start();
if ($_SESSION["role"] !== "admin") { header("Location: ../login.php"); exit; }
require_once "../includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $term = $_POST["term"];
    $subject = $_POST["subject"];
    $score = $_POST["score"];
    $year = $_POST["year"];

    $stmt = $conn->prepare("INSERT INTO results (student_id, term, subject, score, year) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$student_id, $term, $subject, $score, $year]);

    $message = "Result uploaded successfully!";
}
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Upload Result</h2>
    <?php if ($message): ?><p class="text-green-600 mb-4"><?= $message ?></p><?php endif; ?>
    <form method="POST" class="space-y-4">
        <input type="number" name="student_id" required placeholder="Student ID" class="w-full p-2 border rounded">
        <input type="text" name="term" required placeholder="Term (e.g. 1st Term)" class="w-full p-2 border rounded">
        <input type="text" name="subject" required placeholder="Subject" class="w-full p-2 border rounded">
        <input type="number" name="score" required placeholder="Score" class="w-full p-2 border rounded">
        <input type="number" name="year" required placeholder="Year" class="w-full p-2 border rounded">
        <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700">Upload</button>
    </form>
</div>
<?php include "../includes/footer.php"; ?>