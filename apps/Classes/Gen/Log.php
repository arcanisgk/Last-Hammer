<?php

namespace IcarosNet\LastHammer\Gen;
use CoreApp;

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
        $logdate  = \IcarosNet\LastHammer\Gen\Date::_getInstance()->genDate('E');
        foreach ($logsname as $logname => $availability) {
            if ($availability) {
                $pathlog     = PATHS['LOGS'].$logname.'/';
                $fullpathlog = PATHS['LOGS'].$logname.'/'.$logdate.'.log';
                if (!\IcarosNet\LastHammer\Gen\File::_getInstance()->validateLocalDirectory($pathlog)) {
                    \IcarosNet\LastHammer\Gen\File::_getInstance()->createLocalDirectory($pathlog);
                }
                if (!\IcarosNet\LastHammer\Gen\File::_getInstance()->validateLocalFile($fullpathlog)) {
                    \IcarosNet\LastHammer\Gen\File::_getInstance()->crateLocalFile($fullpathlog);
                }
            }
        }
    }

    public function setLogReg($cont, $log)
    {
        //echo var_dump(CoreApp::$oclass);
        $date = \IcarosNet\LastHammer\Gen\Date::_getInstance() ->genDate('E');
        $path = PATHS['LOGS'].$log.'/'.$date.'.log';
        \IcarosNet\LastHammer\Gen\File::_getInstance()->writeFile($cont, $path);
    }
}
