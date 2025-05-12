<?php
namespace Models\Interfaces;
interface UserInterface {
    public  function login(string $username, string $password): bool;
    public function getUserById(int $userId): ?array;
    public function logout(): void;
}
?>