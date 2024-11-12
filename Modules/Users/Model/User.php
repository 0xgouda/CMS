<?php 
namespace Modules\Users\Model;
class User extends \Src\Entity
{
    public function __construct() {
        parent::__construct('users');
    }

    protected function initFields() {
        $this->fields = [
            'name',
            'username',
            'hash'
        ];
    }

    public function updateCondition(): bool {
        return false;
    }
}