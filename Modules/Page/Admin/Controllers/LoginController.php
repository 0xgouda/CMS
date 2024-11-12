<?php 
namespace Modules\Page\Admin\Controllers;
class LoginController extends \Src\MainController {
    public function runBeforeAction() {
        if ($_SESSION['is_admin'] ?? false == true) {
            header('Location: /admin/dashboard');
            exit();
        }

        $section = $_GET['section'] ?? 'default';
        if ($section != 'login') {
            header('Location: /admin/login');
            exit();
        }

        return true;
    }

    public function defaultAction(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $auth = new \Src\Auth;
            if ($auth->checkLogin($username, $password)) {
                $_SESSION['is_admin'] = true;
                header('Location: /admin/dashboard');
                exit();
            }
        }

        include VIEW_PATH . 'admin/login.html';
        unset($_SESSION['validation']['errors']);
    }
}