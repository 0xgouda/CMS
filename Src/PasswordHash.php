<?php
namespace Src;
class PasswordHash
{
    public static function getHash($password): string {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}