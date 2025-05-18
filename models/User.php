<?php
namespace Models;
use Models\Interfaces\UserInterface;
use Models\Interfaces\DatabaseInterface;
require_once __DIR__ . '/../models/Interfaces/UserInterface.php';
require_once __DIR__ . '/../models/Interfaces/DatabaseInterface.php';

class User implements UserInterface
{
    private $pdo;
    private $database; 
    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
        $this->pdo = $this->database->connect(); 
    }

    public function login(string $username, string $password): bool
    {
        // 1. جستجو کاربر بر اساس نام کاربری
        $stmt = $this->pdo->prepare("SELECT id, password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        // 2. بررسی وجود کاربر و تطابق رمز عبور
        if ($user && password_verify($password, $user['password'])) {
            // ورود موفقیت‌آمیز
            $_SESSION['user_id'] = $user['id']; // ذخیره ID کاربر در جلسه
            return true;
        } else {
            // ورود ناموفق
            return false;
        }
    }

    public function getUserById(int $userId): ?array
    {
        $stmt = $this->pdo->prepare("SELECT id, username, email /* اضافه کردن سایر فیلدها */ FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function logout(): void
    {
        session_destroy(); // پاک کردن تمام داده‌های جلسه
        unset($_SESSION['user_id']); // حذف متغیر user_id (اختیاری)
    }
}
?>