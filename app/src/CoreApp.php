<?php

namespace IcarosNet\LastHammer;

use IcarosNet\LastHammer\Gen\App;
use IcarosNet\LastHammer\Mvc\Controller;

class CoreApp
{
    public static $oclass = null;

    public static $ovars = null;

    private static $instance = null;

    public static function getInstance(): CoreApp
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    public function goCoreApp()
    {


        $this->popClass();
        $app = App::getInstance();
        $controller = Controller::getInstance();

        $app->runInit();
        $controller->runController();
        $app->runClose();
    }

    private function popClass()
    {
        Manager::getInstance()->LoadClass();
    }
}