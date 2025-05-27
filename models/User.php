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


        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            return true;
        } else {

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
        session_destroy();
        unset($_SESSION['user_id']);
    }
}
?>