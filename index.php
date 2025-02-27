<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/utils/session.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/routes.php';

try {
    $pdo = getDatabaseConnection();
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$page = $_GET['page'] ?? 'home';
$routes = require __DIR__ . '/config/routes.php';

if (isset($routes[$page])) {
    $controllerName = $routes[$page]['controller'];
    $method = $routes[$page]['method'];

    if (class_exists($controllerName)) {
        $controller = new $controllerName($pdo);
        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            require_once __DIR__ . '/views/404.php';
        }
    } else {
        require_once __DIR__ . '/views/404.php';
    }
} else {
    require_once __DIR__ . '/views/404.php';
}