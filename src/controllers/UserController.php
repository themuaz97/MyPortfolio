<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../core/Controller.php';
require_once '../models/User.php';
require_once '../../db/Database.php';

class UserController extends Controller {
    public $userModel;
    public $db;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new User($this->db);
    }

    // Create User
    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize inputs
            $name = htmlspecialchars(trim($_POST['name']));
            $username = htmlspecialchars(trim($_POST['username']));
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $phone_no = htmlspecialchars(trim($_POST['phone_no']));
            $summary = htmlspecialchars(trim($_POST['summary']));
            $password = trim($_POST['password']);
            
            // Validate inputs
            $errors = [];
            if (!$name || !$username || !$email || !$phone_no || !$summary || !$password) {
                $errors[] = "All fields are required.";
            }

            if (!empty($errors)) {
                echo implode('<br>', $errors);
                return;
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Save user
            if ($this->userModel->create($name, $username, $email, $phone_no, $summary, $hashedPassword)) {
                echo json_encode(['message' => 'User created successfully!']);
            } else {
                echo json_encode(['message' => 'Failed to create user.']);
            }
        } else {
            // Show the user creation form
            $this->view('create_user');
        }
    }

    // Read Users
    public function read() {
        $stmt = $this->userModel->read();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->view('users_list', ['users' => $users]);
    }

    // Read a single user by ID
    public function readSingle($id) {
        $stmt = $this->userModel->readSingle($id);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->view('user_detail', ['user' => $user]);
    }

    // Update User
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->update($id, $name, $email, $password)) {
                echo "User updated successfully!";
            } else {
                echo "Failed to update user.";
            }
        } else {
            // Show the update form
            $stmt = $this->userModel->readSingle($id);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->view('update_user', ['user' => $user]);
        }
    }

    // Delete User
    public function delete($id) {
        if ($this->userModel->delete($id)) {
            echo "User deleted successfully!";
        } else {
            echo "Failed to delete user.";
        }
    }
}
