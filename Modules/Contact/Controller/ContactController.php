<?php
namespace Modules\Contact\Controller;
class ContactController extends \Src\MainController
{
    protected function runBeforeAction()
    {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1) {
            $pageObj = new \Modules\Page\Model\Page();
            $pageObj->findBy('id', 4);
            $variables['pageObj'] = $pageObj;

            $this->template->view('Contact/View/already-contacted', $variables);
            return false;
        }
        return true;
    }

    protected function defaultAction(): void
    {
        $pageObj = new \Modules\Page\Model\Page();
        $pageObj->findBy('id', 3);
        $variables['pageObj'] = $pageObj;

        $this->template->view('Contact/View/contact', $variables);
    }

    protected function submitFormAction(): void
    {
        $pageObj = new \Modules\Page\Model\Page();
        $pageObj->findBy('id', 5);
        $variables['pageObj'] = $pageObj;

        $_SESSION['has_submitted_the_form'] = 1;
        $this->template->view('Contact/View/contact-thank-you', $variables);
    }
}
