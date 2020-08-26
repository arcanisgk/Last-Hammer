<?php

namespace IcarosNet\LastHammer\Gen;

use CoreApp;

class App
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function checkInstall()
    {
        $file_mgr = &CoreApp::$oclass['GEN']['FILES'];
        $confinc = PATHS['SOFTWARE'] . 'config-inc.php';
        $valInstall = $file_mgr->validateLocalFile($confinc);
        if (!$valInstall) {
            return 3;
        } else {
            $file_mgr->requireFile($confinc);
            if ($this->checkUpdate()) {
                return 2;
            } elseif ($this->checkLicense()) {
                return 1;
            }
        }
        return false;
    }

    public function checkLicense()
    {
        return false; //hack Check License With Remote Version;
    }

    public function checkUpdate()
    {
        $installver = &CoreApp::$ovars['SYS']['CONF']['SOFTWARE']['SOFT_VERSION'];
        $userver = CLIENT_DATA['SOFTWARE']['VERSION'];
        $remotever = $this->getRemoteVersion();
        return ($installver == $userver && $installver == $remotever ? false : true);
    }

    public function getRemoteVersion()
    {
        return CLIENT_DATA['SOFTWARE']['VERSION']; //hack Update
    }

    public function runClose()
    {
        $gen = &CoreApp::$oclass['GEN'];
        $log = \IcarosNet\LastHammer\Gen\Log::_getInstance();
        $vars = Vars::_getInstance();
        if (!isset($_SESSION)) {
            $cont = $log->buildLogEvent();
            $log->setLogReg($cont, 'user');
        } else {
            if (true === CoreApp::$ovars['SYS']['SERVICE']['CRON']) {
                $cont = $log->buildLogCron();
                $log->setLogReg($cont, 'system');
            } elseif (true === CoreApp::$ovars['SYS']['SERVICE']['WEBSER']) {
                $cont = $log->buildLogWebServ();
                $log->setLogReg($cont, 'system');
            }
        }
        $vars->destVars();
    }

    public function runInit()
    {

        $gen = &CoreApp::$oclass['GEN'];


        Vars::_getInstance()->initVar();
        Log::_getInstance()->initLog();
        ExecTime::_getInstance()->initTimeExec();
        Memory::_getInstance()->initMemoryUsage();
        Session::_getInstance()->initSession();
        Http::_getInstance()->initClientCommunication();
        Device::_getInstance()->detectDevice();
        Log::_getInstance()->getUserStatus();

    }
}
