<?php

require __DIR__.'/vendor/autoload.php';



$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Route it up!
switch ($request_uri[0]) {

    case '/toDoList/':
        require 'resources/Home.php';
        break;
    case '/toDoList/login/':
        require 'inc/Login_process.php';
        break;
    case '/toDoList/add/':
        require 'resources/Add_view.php';
        break;
    default:
        echo ($request_uri[0]);
        header('HTTP/1.0 404 Not Found');
        break;
}