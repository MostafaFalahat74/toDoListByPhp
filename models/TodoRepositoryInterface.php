<?php
namespace Models;
interface TodoRepositoryInterface {
    public function getTask(int $id): ?array;
    public function getAllTasks(): array;
    public function addTask(string $task): bool;
    public function completeTask(int $id): bool;
    public function deleteTask(int $id): bool;
    public function updateTaskStatus(int $id, bool $status): bool;
}
?>