<?php
namespace Modules\Page\Model;
class Page extends \Src\Entity
{
    public function __construct() {
        parent::__construct('pages');
    }

    protected function initFields() {
        $this->fields = [
            'title',
            'content'
        ];
    }

    public function updateCondition(): bool {
        if (!isset($this->title) || !isset($this->content) || !isset($this->id))
            return false;
        return true;
    }
}