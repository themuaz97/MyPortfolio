<?php
class App {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Check for API prefix in the URL
        if (count($url) > 0 && $url[0] === 'api') {
            // Handle API requests
            $this->handleApiRoutes($url);
        } else {
            // Handle regular web routes
            $this->handleWebRoutes($url);
        }
    }

    private function handleApiRoutes($url) {
        if (count($url) > 1 && file_exists('src/controllers/' . ucfirst($url[1]) . 'Controller.php')) {
            $this->controller = ucfirst($url[1]);
            unset($url[1]);
        }

        require_once 'src/controllers/' . $this->controller . 'Controller.php';
        $this->controller = new $this->controller;

        if (count($url) > 1 && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function handleWebRoutes($url) {
        if (count($url) > 0 && file_exists('src/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once 'src/controllers/' . $this->controller . 'Controller.php';
        $this->controller = new $this->controller;

        if (count($url) > 1 && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', rtrim($_GET['url'], '/'));
        }
        return [];
    }
}

