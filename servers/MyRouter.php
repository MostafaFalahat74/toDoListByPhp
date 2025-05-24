<?php

namespace servers;

use Controllers\HomeController;

class MyRouter
{
    public static function create($uri): MyRouter
    {

            $home = new  HomeController();

            if ($uri === 'toDoList') {
                return $home->index();
            }
            dd("false");


    }
}