<?php
namespace Src\Interfaces;
interface ValidateInterface {
    public function validateRule(string $input): bool;

    public function getErrorMessage(): string;
}