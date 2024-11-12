<?php
namespace Src\ValidationRules;
class ValidateMaximumLen implements \Src\Interfaces\ValidateInterface
{
    private string $errorMessage = "";
    public function __construct(private int $maximumLen) {}

    public function validateRule(string $input): bool {
        if  (strlen($input) <= $this->maximumLen) {
            return true;
        }
        $this->errorMessage = "Characters Length must be less than $this->maximumLen";
        return false;
    }

    public function getErrorMessage(): string {
        return $this->errorMessage;
    }
}