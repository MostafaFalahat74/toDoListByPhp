<?php
session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
die('درخواست نامعتبر (CSRF token).');
}
?>