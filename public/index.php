<?php 
declare(strict_types=1);
session_start();

define('ROOT_PATH', dirname(__FILE__) . '/../');
define('VIEW_PATH', ROOT_PATH . 'View/');
define('MODULE_PATH', ROOT_PATH . 'Modules/');

// Auto Load
spl_autoload_register(function ($class_name) {
    $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Start Database Connection
$dbh = \Src\DataBaseConnection::getInstance();
$dbh->connect('localhost', 'cms', 'root', '');

// the routing logic
$section = $_GET['section'] ?? 'home';

$router = new \Src\Router();

if ($router->findBy('pretty_url', $section)) {
    $action = $router->action ? $router->action : $_POST['action'] ?? 'default';
    $moduleName = '\Modules\\' . ucfirst($router->module)
        . '\Controller\\' . ucfirst($router->module) . 'Controller';
}

if (isset($moduleName) && method_exists($moduleName, $action . 'Action')) {
    $Controller = new $moduleName();
    $Controller->template = new \Src\Template('layout/default');
    $Controller->setEntityId($router->entity_id);
    $Controller->runAction($action);
} 
else {
    header("Location: /");
    exit();
}