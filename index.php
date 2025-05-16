<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? ''))) {
    die('درخواست نامعتبر (CSRF token).');
}
 require __DIR__ . '/vendor/autoload.php';

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
$path = $request_uri[0];

switch ($path) {
    case '/toDoList/':
    case '/toDoList/index.php':
        $controller = new Controllers\HomeController();
        $controller->index();
        break;
    case '/toDoList/login/':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Models\Database();
            $userModel = new Models\User($database->connect());
            if ($userModel->login($_POST['username'] ?? '', $_POST['password'] ?? '')) {
                header('Location: /toDoList/');
                exit();
            } else {
                require __DIR__ . '/resources/views/LoginView.php';
            }
        } else {
            require __DIR__ . '/resources/views/LoginView.php';
        }
        break;
    case '/toDoList/add/':
        $controller = new Controllers\AddController();
        $controller->index();
        break;
    case '/toDoList/add/store':
        $controller = new Controllers\AddController();
        $controller->store();
        break;
    case '/toDoList/complete/':
        $controller = new Controllers\CompleteController();
        $controller->update();
        break;
    case '/toDoList/delete/':
        $controller = new Controllers\DeleteController();
        $controller->destroy();
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        break;
}