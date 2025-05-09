<?php
namespace Models;

interface DatabaseInterface {
    public function connect(): \PDO;
}
?>