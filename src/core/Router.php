<?php
class Router {
    private $routes = [];

    // Define the route
    public function add($method, $uri, $action) {
        $this->routes[] = compact('method', 'uri', 'action');
    }

    // Dispatch the request to the appropriate route
    public function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['uri'] === $uri) {
                // Extract controller and method from the action string
                list($controller, $method) = explode('@', $route['action']);
                $this->callAction($controller, $method);
                return;
            }
        }
        
        // If no matching route found
        echo json_encode(['message' => 'Route not found']);
    }

    // Call the controller method
    private function callAction($controller, $method) {
        require_once "src/controllers/{$controller}.php";
        $controllerInstance = new $controller();
        $controllerInstance->$method();
    }
}
