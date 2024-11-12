<?php
namespace Src;
class mainController
{
    protected $entityId;
    public \Src\Template $template;

    public $log = null;
    public function runAction($actionName)
    {
        if (method_exists($this, 'runBeforeAction')) {
            if (!$this->runBeforeAction())
                return;
        }

        $actionName .= 'Action';
        if (method_exists($this, $actionName)) {
            $this->$actionName();
        }
    }

    public function setEntityId($entityId) {
        $this->entityId = $entityId;
    }
}
