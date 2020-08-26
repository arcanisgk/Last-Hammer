<?php
require_once 'configs/const/loader.php';

class CoreApp
{
    public static $oclass = null;

    public static $ovars = null;

    private static $instance = null;

    public static function _getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function goCoreApp()
    {
        $this->popClass();
        $app = \IcarosNet\LastHammer\Gen\App::_getInstance();
        $controller = \IcarosNet\LastHammer\Mvc\Controller::_getInstance();

        $app->runInit();
        $controller->runController();
        $app->runClose();
    }

    private function popClass()
    {
        require_once FILEROOT . '/apps/class-manager.php';
        ClassManager::_getInstance()->LoadClass();
    }
}

ob_start();
CoreApp::_getInstance()->goCoreApp();
