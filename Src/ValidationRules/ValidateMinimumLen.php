<?php
namespace Src\ValidationRules;
class ValidateMinimumLen implements \Src\Interfaces\ValidateInterface
{
    private string $errorMessage = "";
    public function __construct(private int $minimumLength) {}

    public function validateRule(string $input): bool {
        if (strlen($input) >= $this->minimumLength) {
            return true;
        } 
        $this->errorMessage = "Characters Length must be greater than $this->minimumLength";
        return true;
    }

    public function getErrorMessage(): string {
        return $this->errorMessage;
    }
}