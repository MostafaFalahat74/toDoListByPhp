<?php
namespace Facades;
use Helpers\FactorClass;
class RouteFacade
{
    protected static FactorClass $factory;

    protected static function boot()
    {
        if (!isset(self::$factory)) {
            self::$factory = FactorClass::create();
        }
    }
    public static function add(){
        self::boot();
        $addController = self::$factory->makeClass('Controllers\AddController');
        $_SERVER['REQUEST_METHOD'] === 'POST'? $addController->store():$addController->index();
    }
    public static function delete(){
        self::boot();
        $deleteController = self::$factory->makeClass('Controllers\DeleteController');
        $deleteController->destroy();
    }
    public static function complete(){
        self::boot();
        $completeController = self::$factory->makeClass('Controllers\CompleteController');
        $completeController->update();
    }
    public static function home()
    {
        self::boot();
        $homeController = self::$factory->makeClass('Controllers\HomeController');
        $homeController->index();
    }
        public static function login()
        {
            self::boot();
            $loginController = self::$factory->makeClass('Controllers\LoginController');
            $_SERVER['REQUEST_METHOD'] === 'POST'? $loginController->login() :$loginController->index();
        }
}