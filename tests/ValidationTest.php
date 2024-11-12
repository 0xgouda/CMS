<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

define('ROOT_PATH', __DIR__ . '/../');

// Auto Load
spl_autoload_register(function ($class_name) {
    $file = ROOT_PATH . str_replace('\\', '/', $class_name)  . '.php'; 
    if (file_exists($file)) {
        require_once $file;
    }
});


final class ValidationTest extends TestCase
{
    public function testValidation(): void
    {
        $validationClass = new \Src\Validator;
        $validationClass->addRule(new \Src\ValidationRules\ValidateSpecialChars());

        $this->assertEquals(false, $validationClass->validate('ahmed'));
    }
}