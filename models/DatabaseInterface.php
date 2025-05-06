<?php
// Interface برای اتصال به پایگاه داده
interface DatabaseInterface {
    public function connect(): PDO;
}
?>