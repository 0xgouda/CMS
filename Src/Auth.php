<?php 
namespace Src;
class Auth {
    private Validator $validator;
    const loginError = "Invalid Username or Password.";
    public function checkLogin($username, $password): bool {
        $userObj = new \Modules\Users\Model\User;
        if ($userObj->findBy('username', $username)) {
            if ($userObj->username == $username &&
                password_verify($password, $userObj->hash)) return true;
        }
        $_SESSION['validation']['errors'][] = self::loginError;
        return false;
    }

    public function validatePassword($password): bool {
        $validator = new Validator();
        return $validator
            ->addRule(new \Src\ValidationRules\ValidateMaximumLen(20))
            ->addRule(new \Src\ValidationRules\ValidateMinimumLen(4))
            ->addRule(new \Src\ValidationRules\ValidateSpecialChars())
            ->validate($password);
    }
}