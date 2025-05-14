<?php
namespace Models;
use Models\Interfaces\DatabaseInterface;
require_once __DIR__ . '/../models/Interfaces/DatabaseInterface.php';
class Database implements DatabaseInterface
{
    private $host = 'localhost';
    private $dbname = 'todolists';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function connect(): \PDO // ← حتماً با backslash
    {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
                $this->pdo = new \PDO($dsn, $this->username, $this->password); // ← اینجا هم
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // ← و اینجا
            } catch (\PDOException $e) {
                die("خطا در اتصال به پایگاه داده: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
?>