<?php
namespace Src\ValidationRules;
class ValidateSpecialChars implements \Src\Interfaces\ValidateInterface
{
    private string $errorMessage = "";
    public function __construct(private string $expression = "/[^a-zA-Z0-9]/") {}

    public function validateRule(string $input): bool {
        if (preg_match($this->expression, $input)) {
            return true;
        }
        $this->errorMessage = "1 special character required";
        return false;
    }

    public function getErrorMessage(): string {
        return $this->errorMessage;
    }
}