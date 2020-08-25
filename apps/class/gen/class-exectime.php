<?php

class ClassExectimeManager
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self ::$instance instanceof self) {
            self ::$instance = new self;
        }
        return self ::$instance;
    }

    public function execRefresh($hey)
    {
        CoreApp ::$oclass['GEN']['VARS'] -> destVars();
        echo '<meta http-equiv="refresh" content="' . $hey['time'] . '"><script data-logout type="text/javascript">alert("' . $hey['why'] . '");window.location.reload();</script>';
    }

    public function getTimeExec()
    {
        $this -> endTimeExec();
        $time = number_format(CoreApp ::$ovars['SYS']['EXECTIME']['END'] - CoreApp ::$ovars['SYS']['EXECTIME']['INIT'], 10);
        CoreApp ::$ovars['SYS']['EXECTIME']['ENDOUTPUT'] = CoreApp ::$oclass['GEN']['DATE'] -> calcRunTime($time);
    }

    private function endTimeExec()
    {
        CoreApp ::$ovars['SYS']['EXECTIME']['END'] = microtime(true);
    }

    public function initTimeExec()
    {
        CoreApp ::$ovars['SYS']['EXECTIME']['INIT'] = microtime(true);
    }
}
