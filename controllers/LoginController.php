<?php
namespace Controllers;

use Models\User;
use Models\Database;
use Helpers\RedirectHelper;

session_start();

class LoginController
{
    public function showLoginForm($error = null)
    {
        die('ااااااااااا');
        exit();
        $csrfToken = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $csrfToken;

        require __DIR__ . '/../resources/views/LoginView.php';
    }

    public function login()
    {
        die('xxxxx');
        exit();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            RedirectHelper::redirect('/toDoList/login');
        }

        if (
            empty($_POST['csrf_token']) ||
            $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')
        ) {
            die('درخواست نامعتبر (CSRF).');
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $db = new Database();
        $user = new User($db);

        if ($user->login($username, $password)) {
           // RedirectHelper::redirect('/toDoList/kkkkkkkkk');
          // RedirectHelper::redirect('/toDoList/');
            die(' RedirectHelper::redirect(/toDoList/kkkkkkkkk');
            exit();
          //  RedirectHelper::redirect('/toDoList/kkkkkkkkk');
        } else {
            die(' Redi((((((((((((((((((((()))))))))))))))))))))kkk');
            exit();
           // $this->showLoginForm('نام کاربری یا رمز عبور اشتباه است.');
        }
    }
}