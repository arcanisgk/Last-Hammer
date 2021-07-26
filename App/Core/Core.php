<?php

namespace IcarosNet\LastHammer\App\Core;


class Core
{
    public static $oclass = null;

    public static $ovars = null;

    private static $instance = null;

    public static function getInstance(): Core
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    public function goCoreApp()
    {

        echo 'goCoreApp<br>';
        //echo $foo;
        /*
        $this->popClass();
        App::getInstance()->runInit();
        Controller::getInstance()->runController();
        App::getInstance()->runClose();
        */
    }

    private function popClass()
    {
        //Manager::getInstance()->LoadClass();
    }
}