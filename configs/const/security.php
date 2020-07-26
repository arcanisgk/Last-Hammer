<?php
if (!defined('ZONE')) {
    define('ZONE', CLIENT_DATA['SOFTWARE']['ZONE']);
}
if (!defined('IPUSER')) {
    $ipkeys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];
    foreach ($ipkeys as $key => $value) {
        if ('' != getenv($value)) {
            $ipuser = getenv($value);
            break;
        } else {
            $ipuser = 'UNKNOWN';
        }
    }
    define('IPUSER', $ipuser);
}
if (!defined('PROTOCOL')) {
    define('PROTOCOL', CONF_DATA['SETUP']['PROTOCOL']);
}
if (!defined('SESSION_EXPIRATION')) {
    define('SESSION_EXPIRATION', CONF_DATA['SETUP']['SESSION_EXPIRATION']);
}
if (!defined('SESSION_INACTIVITY')) {
    define('SESSION_INACTIVITY', CONF_DATA['SETUP']['SESSION_INACTIVITY']);
}
$httpsecuritycookies = (PROTOCOL == 'HTTPS') ? true : false;
if (!defined('COOKIES_SECURITY')) {
    define('COOKIES_SECURITY', $httpsecuritycookies);
}
if (!defined('COOKIES_HTTPONLY')) {
    define('COOKIES_HTTPONLY', CONF_DATA['SETUP']['COOKIES_HTTPONLY']);
}
if (!defined('USER_ACC_RESTORE')) {
    define('USER_ACC_RESTORE', CONF_DATA['SETUP']['USER_ACC_RESTORE']);
}
if (!defined('USER_ACC_RESTORE_BY')) {
    define('USER_ACC_RESTORE_BY',
        implode(',', CONF_DATA['SETUP']['USER_ACC_RESTORE_BY']));
}
if (!defined('USER_ACC_CHANGE_PASS')) {
    define('USER_ACC_CHANGE_PASS', CONF_DATA['SETUP']['USER_ACC_CHANGE_PASS']);
}
if (!defined('USER_ACC_REGISTRY')) {
    define('USER_ACC_REGISTRY', CONF_DATA['SETUP']['USER_ACC_REGISTRY']);
}
