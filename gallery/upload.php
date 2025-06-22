<?php
session_start();
if ($_SESSION["role"] !== "admin") exit;
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caption = $_POST["caption"];
    $image = "";

    if ($_FILES["image"]["tmp_name"]) {
        $image = "uploads/gallery/" . time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $image);
    }

    $stmt = $conn->prepare("INSERT INTO gallery (image_url, caption) VALUES (?, ?)");
    $stmt->execute([$image, $caption]);

    header("Location: manage.php");
    exit;
}
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Upload Gallery Image</h2>
    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="file" name="image" required class="w-full">
        <input type="text" name="caption" placeholder="Caption" class="w-full p-2 border rounded">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Upload</button>
    </form>
</div>
<?php include "../includes/footer.php"; ?>