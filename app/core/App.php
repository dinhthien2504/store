<?php
namespace app\core;

use app\core\Router;
use app\configs\Routes;
class App {
    private $__controller, $__action, $__router;
    public function __construct() {
        $this->__router = new Router();
        Routes::setupRoutes($this->__router);
        $url = $_SERVER['PATH_INFO'] ?? '/';
        $this->__router->dispatch($url);
    }
}