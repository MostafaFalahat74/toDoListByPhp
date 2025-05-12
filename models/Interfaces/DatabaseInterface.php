<?php
namespace Models\Interfaces;

interface DatabaseInterface {
    public function connect(): \PDO;
}
?>