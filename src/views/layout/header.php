<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Admin Panel'; ?></title>

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