<?php
session_start();
require_once "includes/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["name"] = $user["full_name"];

        // Redirect by role
        switch ($user["role"]) {
            case "admin":
                header("Location: dashboard/admin.php");
                break;
            case "student":
                header("Location: dashboard/student.php");
                break;
            case "parent":
                header("Location: dashboard/parent.php");
                break;
        }
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<?php include "includes/header.php"; ?>
<div class="max-w-md mx-auto mt-20 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Portal Login</h2>
    <?php if ($error): ?>
        <p class="text-red-500 mb-4"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" class="space-y-6">
        <input type="email" name="email" required class="w-full p-2 border rounded" placeholder="Email">
        <input type="password" name="password" required class="w-full p-2 border rounded" placeholder="Password">
        <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700">Login</button>
    </form>
</div>
<?php include "includes/footer.php"; ?>