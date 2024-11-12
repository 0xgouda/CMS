<?php 
namespace Modules\Page\Admin\Controllers;

class DashboardController extends \Src\MainController {

    public function runBeforeAction() {
        if ($_SESSION['is_admin'] ?? false == true) return true;
        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';
        if ($action != 'login') {
            header('Location: /admin/login');
            exit();
        } else return true;
    }
    public function defaultAction() {
        $PagesObj = new \Modules\Page\Model\Page();
        $variables['pages'] = $PagesObj->findAll();
        $variables['dashboardActive'] = true;

        $this->template->view('Page/Admin/View/page-list', $variables);
    }

    public function editAction() {
        $pageObj = new \Modules\Page\Model\Page();
        $result = $pageObj->findBy('id', $_GET['id']);
        if (!$result) {
            header('Location: /admin/');
            exit();
        }            

        $variables['page'] = $result;
        $variables['pageActive'] = true;

        $this->template->view('Page/Admin/View/page-edit', $variables);
    }

    public function updateAction(): void {
        $pageObj = new \Modules\Page\Model\Page();
        $pageObj->findBy('id', $_POST['id']);
        $pageObj->setValues($_POST);
        $status = $pageObj->save();

        if ($this->log != NULL) {
            $this->log->warning("Admin has updated Page $pageObj->id  to be", ['title' => $pageObj->title, 
            'content' => $pageObj->content]);
        }

        header("Location: /admin");
        exit();
    }
}