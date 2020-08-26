<?php

namespace IcarosNet\LastHammer\Gen;

class Log
{
    private static $instance = null;

    public static function getInstance(): Log
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    public function buildLogCron() {}

    public function buildLogEvent() {}

    public function buildLogWebServ() {}

    public function initLog()
    {
        $logsname = LOG_TYPES;
        $logdate  = Date::getInstance()->genDate('E');
        foreach ($logsname as $logname => $availability) {
            if ($availability) {
                $pathlog     = PATHS['LOGS'].$logname.'/';
                $fullpathlog = PATHS['LOGS'].$logname.'/'.$logdate.'.log';
                if (!File::getInstance()->validateLocalDirectory($pathlog)) {
                    File::getInstance()->createLocalDirectory($pathlog);
                }
                if (!File::getInstance()->validateLocalFile($fullpathlog)) {
                    File::getInstance()->crateLocalFile($fullpathlog);
                }
            }
        }
    }

    public function setLogReg($cont, $log)
    {
        //echo var_dump(CoreApp::$oclass);
        $date = Date::getInstance() ->genDate('E');
        $path = PATHS['LOGS'].$log.'/'.$date.'.log';
        File::getInstance()->writeFile($cont, $path);
    }
}
