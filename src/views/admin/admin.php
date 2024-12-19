<?php
include '../layout/header.php';

// Check if the user is logged in
// session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
  //     header("Location: login.php");
  //     exit;
  // }
  $title = "Add New User";
  $inputs = [
    ['name' => 'name', 'label' => 'Name', 'type' => 'text'],
    ['name' => 'username', 'label' => 'Username', 'type' => 'text'],
    ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
    ['name' => 'phone_no', 'label' => 'Phone No', 'type' => 'text'],
    ['name' => 'summary', 'label' => 'Summary', 'type' => 'text'],
    ['name' => 'password', 'label' => 'Password', 'type' => 'password'],
  ];
  $action = "../../controllers/UserController.php?action=create"; 
  $submitText = "Add User";
  
  include '../../components/modal.php'; 
?>

<div class="flex">

    <!-- Sidebar -->
    <?php include '../layout/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Users</h1>

        <!-- User Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <div class="flex justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">User List</h2>
            <button onclick="openModal()" class="border border-violet-600 text-violet-600 hover:bg-violet-600 hover:text-white font-bold py-2 px-4 rounded-lg">
              Add
            </button>
          </div>
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

<?php
include '../layout/footer.php';
?>
