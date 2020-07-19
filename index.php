<?php
require_once 'configs/const/loader.php';
class CoreApp
{
    public static $oclass = null;

    public static $ovars = null;

    private static $instance = null;

    public static function AgetInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function goCoreApp()
    {
        ClassManager::AgetInstance()->LoadClass();
        # ? Call to function Example
        CoreApp::$oclass['GEN']['VARS']->expVariable(true, true, false, false, CoreApp::$oclass, get_defined_constants(true)['user']);
    }
}
ob_start();
CoreApp::AgetInstance()->goCoreApp();
