<?php 
declare(strict_types=1);
session_start();

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


define('ROOT_PATH', dirname(__FILE__) . '/../../');
define('VIEW_PATH', ROOT_PATH . 'View/');
define('MODULE_PATH', ROOT_PATH . 'Modules/');

// Auto Load
spl_autoload_register(function ($class_name) {
    $file = ROOT_PATH . str_replace('\\', '/', $class_name)  . '.php'; 
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once ROOT_PATH . 'vendor/autoload.php';

// Start Database Connection
$dbh = \Src\DataBaseConnection::getInstance();
$dbh->connect('localhost', 'cms', 'root', '');

// the routing logic
$section = $_GET['section'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';

$moduleName = "\Modules\Page\Admin\Controllers\\" . ucfirst($section) . 'Controller';
if (method_exists($moduleName, $action . 'Action')) {
    $Controller = new $moduleName();

    if ($section === "dashboard") {
        // create a log channel
        $log = new Logger('CMS');
        $log->pushHandler(new StreamHandler(ROOT_PATH . 'logs.log', Level::Warning));
        $Controller->log = $log;
    }

    $Controller->template = new \Src\Template("admin/layout/default");
    $Controller->runAction($action);
} else {
    header('Location: /admin/');
    exit();
}