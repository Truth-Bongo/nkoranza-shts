<?php
session_start();
if ($_SESSION["role"] !== "admin") exit;
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $category = $_POST["category"];
    $content = $_POST["content"];
    $image = "";

    if ($_FILES["image"]["tmp_name"]) {
        $image = "uploads/news/" . time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $image);
    }

    $stmt = $conn->prepare("INSERT INTO news (title, category, content, image_url) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $category, $content, $image]);

    header("Location: manage.php");
    exit;
}
?>

<?php include "../includes/header.php"; ?>
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Add News</h2>
    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input name="title" placeholder="Title" class="w-full p-2 border rounded" required>
        <input name="category" placeholder="Category" class="w-full p-2 border rounded" required>
        <textarea name="content" placeholder="Content" class="w-full p-2 border rounded" rows="4"></textarea>
        <input type="file" name="image" class="w-full">
        <button class="bg-pink-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
<?php include "../includes/footer.php"; ?>