<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../core/Controller.php';
require_once '../models/User.php';
require_once '../controllers/UserController.php';
require_once '../../db/database.php';

// Initialize Database and Controller
$db = new Database();
$userController = new UserController($db->connect());

// Handle API Endpoints
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'createUser':
            $userController->createUser();
            break;
        default:
            http_response_code(404);
            echo json_encode(['message' => 'Endpoint not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid request']);
}
