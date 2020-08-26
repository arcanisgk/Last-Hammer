<?php

namespace IcarosNet\LastHammer\Gen;

use IcarosNet\LastHammer\CoreApp;

class App
{
    private static $instance = null;

    public static function getInstance(): App
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    public function checkInstall()
    {
        $file_mgr = File::getInstance();
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
        $log = Log::getInstance();
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
        Vars::getInstance()->destVars();
    }

    public function runInit()
    {
        Vars::getInstance()->initVar();
        Log::getInstance()->initLog();
        ExecTime::getInstance()->initTimeExec();
        Memory::getInstance()->initMemoryUsage();
        Session::getInstance()->initSession();
        Http::getInstance()->initClientCommunication();
        Device::getInstance()->detectDevice();
        User::getInstance()->getUserStatus();

    }
}
