<?php
namespace Models;
class User
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
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