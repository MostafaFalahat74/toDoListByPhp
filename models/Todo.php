<?php
require_once 'TodoRepositoryInterface.php';
class Todo implements TodoRepositoryInterface {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function getTask(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM todos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllTasks(): array {
        $stmt = $this->pdo->query("SELECT * FROM todos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addTask(string $task): bool {
        $stmt = $this->pdo->prepare("INSERT INTO todos (task) VALUES (:task)");
        $stmt->bindParam(':task', $task);
        return $stmt->execute();
    }

    public function completeTask(int $id): bool {
        $stmt = $this->pdo->prepare("UPDATE todos SET is_completed = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteTask(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>