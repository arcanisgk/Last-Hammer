<?php
class ClassDeviceManager
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function detectDevice()
    {
        $detect = new Mobile_Detect;
        $device = &CoreApp::$ovars['SYS']['DEVICE']['MOBILE'];
        $device = ($detect->isMobile()) ? true : false;
    }
}
