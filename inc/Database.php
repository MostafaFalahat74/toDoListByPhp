<?php 
class Database {
    private $host = 'localhost';
    private $dbname = 'todolists';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("خطا در اتصال به پایگاه داده: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>