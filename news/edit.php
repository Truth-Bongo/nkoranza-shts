<?php
session_start();
if ($_SESSION["role"] !== "admin") { header("Location: ../login.php"); exit; }
require_once "../includes/db.php";

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM results WHERE id = ?");
$stmt->execute([$id]);
$result = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $term = $_POST["term"];
    $subject = $_POST["subject"];
    $score = $_POST["score"];
    $year = $_POST["year"];

    $stmt = $conn->prepare("UPDATE results SET term=?, subject=?, score=?, year=? WHERE id=?");
    $stmt->execute([$term, $subject, $score, $year, $id]);
    header("Location: manage.php");
    exit;
}
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Result</h2>
    <form method="POST" class="space-y-4">
        <input type="text" name="term" value="<?= $result["term"] ?>" class="w-full p-2 border rounded">
        <input type="text" name="subject" value="<?= $result["subject"] ?>" class="w-full p-2 border rounded">
        <input type="number" name="score" value="<?= $result["score"] ?>" class="w-full p-2 border rounded">
        <input type="number" name="year" value="<?= $result["year"] ?>" class="w-full p-2 border rounded">
        <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded">Save Changes</button>
    </form>
</div>
<?php include "../includes/footer.php"; ?>