<?php

namespace Helpers;
class FactorClass
{

    public static function create(): FactorClass
    {
        return new FactorClass();
    }

    public function makeClass($nameClass)
    {
        if ($nameClass === 'Controllers\LoginController') {
            $database = new \Models\Database(); // یا از طریق DI کانتینر
            $userModel = new \Models\User($database);
            return new \Controllers\LoginController($userModel);
        }
        return new $nameClass();
    }
}