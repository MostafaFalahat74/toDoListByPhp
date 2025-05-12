<?php

require __DIR__.'/vendor/autoload.php';



$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Route it up!
switch ($request_uri[0]) {

    case '/toDoList/':
        require 'resources/views/HomeView.php';
        break;
    case '/toDoList/login/':
        require 'resources/views/LoginView.php';
        break;
    case '/toDoList/add/':
        require 'resources/views/AddView.php';
        break;
    case '/toDoList/index.php':
        require 'resources/views/HomeView.php';
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        break;
}