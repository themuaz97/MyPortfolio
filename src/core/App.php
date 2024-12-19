<?php

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        $apiRoutes = require 'src/router/api.php'; // Load routes from api.php

        // Match the route from the API routes configuration
        $routeKey = implode('/', $url);
        if (isset($apiRoutes[$routeKey])) {
            $route = $apiRoutes[$routeKey];
            $this->controller = $route['controller'];
            $this->method = $route['method'];

            // Require the controller file
            $controllerPath = 'src/controllers/' . $this->controller . '.php';
            if (file_exists($controllerPath)) {
                require_once $controllerPath;

                // Initialize database connection
                $database = new Database();
                $db = $database->connect();

                // Inject the database connection into the controller
                if ($this->controller == 'UserController') {
                    $this->controller = new $this->controller($db);  // Pass the DB connection to the controller
                } else {
                    $this->controller = new $this->controller;
                }
            } else {
                $this->handleError("Controller file not found: $controllerPath");
                return;
            }
        } else {
            // Default behavior: handle as a web route
            if (isset($url[0]) && file_exists('src/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
                $this->controller = ucfirst($url[0]) . 'Controller';
                unset($url[0]);
            }

            require_once 'src/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;

            if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Remaining parts of URL become parameters
        $this->params = $url ? array_values($url) : [];

        // Call the controller and method
        if (method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            $this->handleError("Method {$this->method} not found in controller {$this->controller}");
        }
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return $url;
        }
        return [];
    }

    private function getDatabaseConnection()
    {
        // Assuming you're using PDO for database connection, adjust this according to your actual DB configuration
        try {
            $db = new PDO('mysql:host=localhost;dbname=your_database_name', 'your_username', 'your_password');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    private function handleError($message)
    {
        http_response_code(404);
        echo json_encode(['error' => $message]);
        exit;
    }
}
