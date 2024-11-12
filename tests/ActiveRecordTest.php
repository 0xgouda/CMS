<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \Modules\Page\Model\Page;
use \Src\DataBaseConnection;

define('ROOT_PATH', __DIR__ . '/../');

// Auto Load
spl_autoload_register(function ($class_name) {
    $file = ROOT_PATH . str_replace('\\', '/', $class_name)  . '.php'; 
    if (file_exists($file)) {
        require_once $file;
    }
});

final class ActiveRecordTest extends TestCase
{
    public function testfindAll(): void
    {
        $dbh = DataBaseConnection::getInstance();
        $dbh->connect('127.0.0.1', 'cms', 'root', '');
        $page = new Page();
        $results = $page->findAll();

        $this->assertEquals(1, $results[0]->id);
    }   

    public function testfindBy(): void
    {
        $dbh = DataBaseConnection::getInstance();
        $dbh->connect('127.0.0.1', 'cms', 'root', '');
        $page = new Page();
        $results = $page->findBy('id', 1);

        $this->assertEquals(1, $results->id);
    }  
}