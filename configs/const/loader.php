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
        $path = dirname(__DIR__) . '\\';
    } else {
        $path = dirname($_SERVER['PWD']) . '\\';
    }
} else {
    $ver = 'web';
    $dir = basename($_SERVER['DOCUMENT_ROOT']);
    $path = dirname(__FILE__);
    $path = substr($path, 0, strpos($path, $dir)) . $dir . '\\';
}

$path = (defined('FILEROOT_MASTER') ? FILEROOT_MASTER : $path);

if (!defined('VERSYSTEM')) {
    define('VERSYSTEM', $ver);
}
if (!defined('FILEROOT')) {
    define('FILEROOT', $path);
}
if (!defined('CONST_PATH')) {
    define('CONST_PATH', 'configs/const/');
}

function ArrayChangeKeyCaseRecursive($client_data)
{
    return array_map(function($data) {
        if (is_array($data)) {
            $data = ArrayChangeKeyCaseRecursive($data);
        } else {
            if (strpos($data, ',') !== false && strpos($data, ' ') == false) {
                $data = ArrayChangeKeyCaseRecursive(explode(',', $data));
            }
        }
        return $data;
    }, array_change_key_case($client_data, CASE_UPPER));
}

$client_xml = simplexml_load_string(file_get_contents(FILEROOT . CONST_PATH . 'client.xml'));
$client_data = json_decode(json_encode($client_xml), true);
$conf_xml = simplexml_load_string(file_get_contents(FILEROOT . CONST_PATH . 'conf.xml'));
$conf_data = json_decode(json_encode($conf_xml), true);

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
    if (!defined('PREE')) {
        define('PREE', '');
    }
} else {
    if (!defined('EOL_SYS')) {
        define('EOL_SYS', '<br>');
    }
    if (!defined('PRES')) {
        define('PRES', '<pre style="font-size:12px; margin: 0;">');
    }
    if (!defined('PREE')) {
        define('PREE', '</pre>');
    }
}
if (!defined('CLIENT_DATA')) {
    define('CLIENT_DATA', ArrayChangeKeyCaseRecursive($client_data));
}
if (!defined('CONF_DATA')) {
    define('CONF_DATA', ArrayChangeKeyCaseRecursive($conf_data));
}
date_default_timezone_set(CLIENT_DATA['SOFTWARE']['ZONE']);
/** @noinspection PhpIncludeInspection */
require_once FILEROOT . CONST_PATH . 'security.php';
/** @noinspection PhpIncludeInspection */
require_once FILEROOT . CONST_PATH . 'constant.php';

if (isset($_SERVER['REQUEST_METHOD'])) {
    $data = trim(file_get_contents('php://input'));
    $to_set = null;
    if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
        $to_set = 'POST';
    } elseif (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') == 0) {
        $to_set = 'GET';
    }
    if (!defined('REQUEST_METHOD') && 'POST' == $to_set && (!empty($data) || !empty($_POST))) {
        define('REQUEST_METHOD', $to_set);
    } elseif (!defined('REQUEST_METHOD') && 'GET' == $to_set && (!empty($data) || !empty($_GET))) {
        define('REQUEST_METHOD', $to_set);
    } else {
        if (!defined('REQUEST_METHOD')) {
            define('REQUEST_METHOD', null);
        }
    }
} else {
    if (!defined('REQUEST_METHOD')) {
        define('REQUEST_METHOD', null);
    }
}
if (!defined('REQUEST_TYPE')) {
    define('REQUEST_TYPE', (isset($_SERVER["CONTENT_TYPE"])) ? trim($_SERVER["CONTENT_TYPE"]) : '');
}

if (!defined('MSGINTERFACE')) {
    define('MSGINTERFACE', 'The system is linked to interface data, some delay may occur at start or end.');
}
if (!defined('APPANDROID')) {
    define('APPANDROID', CLIENT_DATA['SOFTWARE']['APPANDROID']);
}
if (!defined('APPIOS')) {
    define('APPIOS', CLIENT_DATA['SOFTWARE']['APPIOS']);
}
