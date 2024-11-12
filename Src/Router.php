<?php 
namespace Src;
class Router extends Entity {
    public function __construct() {
        parent::__construct('routes');
    }

    protected function initFields() {
        $this->fields = [
            'module',
            'action',
            'entity_id',
            'pretty_url'
        ];
    }

    public function updateCondition(): bool {
        return false;
    }
}