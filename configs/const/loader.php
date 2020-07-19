<?php
/*
 * Definitions of Constants
 * Work environment:
 * Local-> 0, Development-> 1, Testing-> 3, Quality-> 5, Production -> 7
 */
$ver = '';
if (php_sapi_name() == 'cli') {
    $ver = 'cli';
    if (!isset($_SERVER['PWD'])) {
        $path = dirname(__DIR__).'\\';
    } else {
        $path = dirname($_SERVER['PWD']);
    }
} else {
    $ver  = 'web';
    $path = $_SERVER['DOCUMENT_ROOT'];
}
if (!defined('VERSYSTEM')) {
    define('VERSYSTEM', $ver);
}
if (!defined('FILEROOT')) {
    define('FILEROOT', $path);
}
if (!defined('CONST_PATH')) {
    define('CONST_PATH', '/configs/const/');
}
function ArrayChangeKeyCaseRecursive($clien_data)
{
    return array_map(function ($data) {
        if (is_array($data)) {
            $data = ArrayChangeKeyCaseRecursive($data);
        } else {
            if (strpos($data, ',') !== false && strpos($data, ' ') == false) {
                $data = ArrayChangeKeyCaseRecursive(explode(',', $data));
            }
        }
        return $data;
    }, array_change_key_case($clien_data, CASE_UPPER));
}

$client_xml = simplexml_load_string(file_get_contents(FILEROOT.CONST_PATH.'/client.xml'));
$clien_data = json_decode(json_encode($client_xml), true);
$conf_xml   = simplexml_load_string(file_get_contents(FILEROOT.CONST_PATH.'/conf.xml'));
$conf_data  = json_decode(json_encode($conf_xml), true);
if (!defined('ENVIRONMENT')) {
    define('ENVIRONMENT', 0);
}
if ('cli' == $ver) {
    if (!defined('EOL_SYS')) {
        define('EOL_SYS', PHP_EOL);
    }
    if (!defined('PRES')) {
        define('PRES', '');
    }
    if (!defined('PRES')) {
        define('PRES', '');
    }
} else {
    if (!defined('EOL_SYS')) {
        define('EOL_SYS', '<br>');
    }
    if (!defined('PRES')) {
        define('PRES', '<pre style="font-size:12px; margin: 0px;">');
    }
    if (!defined('PREE')) {
        define('PREE', '</pre>');
    }
}
if (!defined('CLIENT_DATA')) {
    define('CLIENT_DATA', ArrayChangeKeyCaseRecursive($clien_data));
}
if (!defined('CONF_DATA')) {
    define('CONF_DATA', ArrayChangeKeyCaseRecursive($conf_data));
}
date_default_timezone_set(CLIENT_DATA['SOFTWARE']['ZONE']);
require_once FILEROOT.CONST_PATH.'security.php';
require_once FILEROOT.CONST_PATH.'constant.php';
if (isset($_SERVER['REQUEST_METHOD'])) {
    $data = trim(file_get_contents('php://input'));
    if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
        $to_set = 'POST';
    } elseif (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') == 0) {
        $to_set = 'GET';
    }
    if (!defined('RQMETHOD') && 'POST' == $to_set && (!empty($data) || !empty($_POST))) {
        define('RQMETHOD', $to_set);
    } elseif (!defined('RQMETHOD') && 'GET' == $to_set && (!empty($data) || !empty($_GET))) {
        define('RQMETHOD', $to_set);
    } else {
        if (!defined('RQMETHOD')) {
            define('RQMETHOD', null);
        }
    }
} else {
    if (!defined('RQMETHOD')) {
        define('RQMETHOD', null);
    }
}
if (!defined('RQCONTTYPE')) {
    define('RQCONTTYPE', isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '');
}
if (!defined('MSGINTERFACE')) {
    define('MSGTOUNIX', 'The system is linked to interface data, some delay may occur at start or end.');
}
if (!defined('APPANDROID')) {
    define('APPANDROID', CLIENT_DATA['SOFTWARE']['APPANDROID']);
}
if (!defined('APPIOS')) {
    define('APPIOS', CLIENT_DATA['SOFTWARE']['APPIOS']);
}
require_once FILEROOT.'/apps/class-manager.php';
