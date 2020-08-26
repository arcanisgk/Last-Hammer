<?php

namespace IcarosNet\LastHammer\Gen;
use IcarosNet\LastHammer\CoreApp;

class Log
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
        $logdate  = Date::_getInstance()->genDate('E');
        foreach ($logsname as $logname => $availability) {
            if ($availability) {
                $pathlog     = PATHS['LOGS'].$logname.'/';
                $fullpathlog = PATHS['LOGS'].$logname.'/'.$logdate.'.log';
                if (!File::_getInstance()->validateLocalDirectory($pathlog)) {
                    File::_getInstance()->createLocalDirectory($pathlog);
                }
                if (!File::_getInstance()->validateLocalFile($fullpathlog)) {
                    File::_getInstance()->crateLocalFile($fullpathlog);
                }
            }
        }
    }

    public function setLogReg($cont, $log)
    {
        //echo var_dump(CoreApp::$oclass);
        $date = Date::_getInstance() ->genDate('E');
        $path = PATHS['LOGS'].$log.'/'.$date.'.log';
        File::_getInstance()->writeFile($cont, $path);
    }
}
