<?php
class ClassAppManager
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
        $file_mgr   = &CoreApp::$oclass['GEN']['FILES'];
        $confinc    = PATHS['SOFTWARE'].'config-inc.php';
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
        $userver    = CLIENT_DATA['SOFTWARE']['VERSION'];
        $remotever  = $this->getRemoteVersion();
        return ($installver == $userver && $installver == $remotever ? false : true);
    }

    public function getRemoteVersion()
    {
        return CLIENT_DATA['SOFTWARE']['VERSION']; //hack Update
    }

    public function runClose()
    {
        $gen = &CoreApp::$oclass['GEN'];
        if (!isset($_SESSION)) {
            $cont = $gen['LOGS']->buildLogEvent();
            $gen['LOGS']->setLogReg($cont, 'user');
        } else {
            if (true === CoreApp::$ovars['SYS']['SERVICE']['CRON']) {
                $cont = $gen['LOGS']->buildLogCron();
                $gen['LOGS']->setLogReg($cont, 'system');
            } elseif (true === CoreApp::$ovars['SYS']['SERVICE']['WEBSER']) {
                $cont = $gen['LOGS']->buildLogWebServ();
                $gen['LOGS']->setLogReg($cont, 'system');
            }
        }
        $gen['VARS']->destVars();
    }

    public function runInit()
    {

        $gen = &CoreApp::$oclass['GEN'];

        $gen['VARS']->initVar();
        $gen['LOGS']->initLog();
        $gen['EXECTIME']->initTimeExec();
        $gen['MEMORY']->initMemoryUsage();
        $gen['SESSION']->initSession();
        $gen['HTTP']->initClientCommunication();
        $gen['DEVICE']->detectDevice();
        $gen['USER']->getUserStatus();

    }
}
