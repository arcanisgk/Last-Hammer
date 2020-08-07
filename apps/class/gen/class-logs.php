<?php
class ClassLogsManager
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function buildLogCron() {}

    public function buildLogEvent() {}

    public function buildLogWebServ() {}

    public function initLog()
    {
        $logsname = LOG_TYPES;
        $logdate  = CoreApp::$oclass['GEN']['DATE']->genDate('E');
        foreach ($logsname as $logname => $availability) {
            if ($availability) {
                $pathlog     = PATHS['LOGS'].$logname.'/';
                $fullpathlog = PATHS['LOGS'].$logname.'/'.$logdate.'.log';
                if (!CoreApp::$oclass['GEN']['FILES']->validateLocalDirectory($pathlog)) {
                    CoreApp::$oclass['GEN']['FILES']->createLocalDirectory($pathlog);
                }
                if (!CoreApp::$oclass['GEN']['FILES']->validateLocalFile($fullpathlog)) {
                    CoreApp::$oclass['GEN']['FILES']->crateLocalFile($fullpathlog);
                }
            }
        }
    }

    public function setLogReg($cont, $log)
    {
        //echo var_dump(CoreApp::$oclass);
        $date = CoreApp::$oclass['GEN']['DATE']->genDate('E');
        $path = PATHS['LOGS'].$log.'/'.$date.'.log';
        CoreApp::$oclass['GEN']['FILES']->writeFile($cont, $path);
    }
}
