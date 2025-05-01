<?php
class Todo
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addTask(string $task): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO todos (task) VALUES (:task)");
        $stmt->bindParam(':task', $task);
        return $stmt->execute();
    }
    public function deleteTask(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function completeTask(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE todos SET is_completed = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAllTasks(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM todos ORDER BY created_at DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>