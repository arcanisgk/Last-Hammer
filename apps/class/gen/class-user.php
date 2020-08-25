<?php

class ClassUserManager
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self ::$instance instanceof self) {
            self ::$instance = new self;
        }
        return self ::$instance;
    }

    public function getUserStatus()
    {
        $userl = &CoreApp ::$ovars['USER']['LOGGED'];
        $userl = (isset($_SESSION['UserLogin']) && (true === $_SESSION['UserLogin'])) ? true : false;
    }
}
