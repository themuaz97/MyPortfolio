

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .sidebar {
            width: 250px;
            background-color: #2D3748;
            height: 100vh;
        }

        .sidebar a {
            color: #E2E8F0;
            padding: 15px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover {
            background-color: #4A5568;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar flex-none bg-gray-800 text-white">
            <div class="flex items-center justify-center py-6">
                <h2 class="text-2xl font-semibold">Admin Panel</h2>
            </div>

            <div class="space-y-2">
                <a href="admin.php" class="px-4 py-2 hover:bg-gray-700">Dashboard</a>
                <a href="manageUsers.php" class="px-4 py-2 hover:bg-gray-700">Users</a>
                <a href="logout.php" class="px-4 py-2 hover:bg-gray-700">Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Manage Users</h1>

            <!-- User Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800">User List</h2>
                <table class="min-w-full table-auto mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample user data -->
                        <tr>
                            <td class="border px-4 py-2">1</td>
                            <td class="border px-4 py-2">John Doe</td>
                            <td class="border px-4 py-2">johndoe@example.com</td>
                            <td class="border px-4 py-2">
                                <a href="edit_user.php?id=1" class="text-blue-500">Edit</a> | 
                                <a href="delete_user.php?id=1" class="text-red-500">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">2</td>
                            <td class="border px-4 py-2">Jane Smith</td>
                            <td class="border px-4 py-2">janesmith@example.com</td>
                            <td class="border px-4 py-2">
                                <a href="edit_user.php?id=2" class="text-blue-500">Edit</a> | 
                                <a href="delete_user.php?id=2" class="text-red-500">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>
