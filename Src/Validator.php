<?php
namespace Src;

class Validator
{
    private array $rules = [];
    private array $errorMessages = [];

    public function addRule(\Src\Interfaces\ValidateInterface $rule) {
        $this->rules[] = $rule;
        
        return $this;
    }

    public function validate($value): bool {
        foreach ($this->rules as $rule) {
            $valid = $rule->validateRule($value);
            if (!$valid) {
                $this->errorMessages[] = $rule->getErrorMessage();
                return false;
            }
        }
        return true;
    }

    public function getAllErrorMessages(): array {
        return $this->errorMessages;
    }
}