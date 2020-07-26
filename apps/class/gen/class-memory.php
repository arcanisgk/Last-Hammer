<?php
class ClassMemoryManager
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getMemoryUsage()
    {
        CoreApp::$ovars['SYS']['EXECMEMORY']['USAGE']      = (float) number_format(memory_get_peak_usage() / 1048576, 2) - CoreApp::$ovars['SYS']['EXECMEMORY']['INIT'];
        CoreApp::$ovars['SYS']['EXECMEMORY']['USAGEOUPUT'] = CoreApp::$ovars['SYS']['EXECMEMORY']['USAGE'].' Mb';
    }

    public function getMemoryUsagePeak()
    {
        CoreApp::$ovars['SYS']['EXECMEMORY']['PEAK']      = (float) number_format(memory_get_peak_usage() / 1048576, 2);
        CoreApp::$ovars['SYS']['EXECMEMORY']['PEAKOUPUT'] = CoreApp::$ovars['SYS']['EXECMEMORY']['PEAK'].' Mb';
    }

    public function initMemoryUsage()
    {
        CoreApp::$ovars['SYS']['EXECMEMORY']['INIT'] = (float) number_format(memory_get_usage() / 1048576, 2);
    }
}
