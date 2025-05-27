<?php

require __DIR__ . '/vendor/autoload.php';

use Facades\RouteFacade;
$route = $_SERVER['REQUEST_URI'];
switch ($route) {

    case '/add':
        RouteFacade::add();
        break;
    case '/login':
        RouteFacade::login();
        break;

    case '/delete':
        RouteFacade::delete();
        break;

    case '/complete':
        RouteFacade::complete();
        break;
    case '/home':
    default:
    RouteFacade::home();
    break;
}