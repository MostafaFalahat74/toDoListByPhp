<?php
namespace Controllers;
use Helpers\RedirectHelper;
use Models\User;

class LoginController
{

    private User $userModel;

    public function __construct(User $userModel )
    {
        $this->userModel = $userModel;
    }

    public function index(array $error=[])
    {
            require __DIR__ . '/../resources/views/LoginView.php';
    }

    public function login()
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            $this->index(['وارد کردن نام کاربری و رمز عبور الزامی است.']);
            return;
        }

        if ($this->userModel->login($username, $password)) {http://localhost:8000/
            RedirectHelper::redirect('/toDoList/');
        } else {
            $this->index(['نام کاربری یا رمز عبور اشتباه است.']);
        }
    }
}