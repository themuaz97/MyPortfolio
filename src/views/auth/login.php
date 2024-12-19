<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hardcoded login for simplicity. Replace with database check in a real project.
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == 'password') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Admin Login</h1>
        
        <?php if (isset($error)) { ?>
            <div class="text-red-500 mb-4"><?= $error ?></div>
        <?php } ?>

        <form method="POST">
            <label class="block mb-2">Username</label>
            <input type="text" name="username" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>

            <label class="block mb-2">Password</label>
            <input type="password" name="password" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>

            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg">Login</button>
        </form>
    </div>

</body>

</html>
