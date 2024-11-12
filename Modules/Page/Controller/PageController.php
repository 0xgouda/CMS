<?php
namespace Modules\Page\Controller;
class PageController extends \Src\MainController
{
    protected function defaultAction()
    { 
        $pageObj = new \Modules\Page\Model\Page();
        $pageObj->findBy('id', fieldValue: $this->entityId);
        $variables['pageObj'] = $pageObj;

        $template = new \Src\Template('layout/default');
        $template->view('Page/View/static', $variables);
    }
}
