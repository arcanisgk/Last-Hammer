<?php

namespace IcarosNet\LastHammer\Gen;

use IcarosNet\LastHammer\CoreApp;

class User
{
    private static $instance = null;

    public static function getInstance(): User
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    public function getUserStatus()
    {
        $userl = &CoreApp::$ovars['USER']['LOGGED'];
        $userl = (isset($_SESSION['UserLogin']) && (true === $_SESSION['UserLogin'])) ? true : false;
    }
}
