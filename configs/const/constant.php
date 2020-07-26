<?php
try {
    $environment = [
        0 => [
            'conf' => 'local',
            'desc' => 'Local Server Development'
        ],
        1 => [
            'conf' => 'development',
            'desc' => 'Server Development integration'
        ],
        3 => [
            'conf' => 'testing',
            'desc' => 'Server Testing Lead'
        ],
        5 => [
            'conf' => 'quality',
            'desc' => 'Server Quality End User'
        ],
        7 => [
            'conf' => 'production',
            'desc' => 'Server Production End User'
        ]
    ];
    if (array_key_exists(ENVIRONMENT, $environment)) {
        require_once FILEROOT.CONST_PATH."environment/conf-".$environment[ENVIRONMENT]['conf'].".php";
    } else {
        throw new Exception('The Work Environment Configuration could not be determined.');
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
$paths = [
    'SOFTWARE'  => FILEROOT.'/build/setup/',

    'CLASSEXT'  => FILEROOT.'/apps/class/ext/',
    'CLASSMVC'  => FILEROOT.'/apps/class/mvc/',
    'CLASSGEN'  => FILEROOT.'/apps/class/gen/',
    'CLASSCORE' => FILEROOT.'/apps/class/static/',

    'ABSDATA'   => FILEROOT.'/apps/core/abs/data/',
    'ABSLIST'   => FILEROOT.'/apps/core/abs/elem/',
    'ABSDOCS'   => FILEROOT.'/apps/core/abs/docs/',

    'WORKSPACE' => FILEROOT.'/apps/core/',

    'TPLSTATIC' => FILEROOT.'/html/static/',
    'TPLDASH'   => FILEROOT.'/html/dash/',
    'TPLSITE'   => FILEROOT.'/html/site/',
    'TPLSTORE'  => FILEROOT.'/html/store/',

    'PRINT'     => FILEROOT.'/print/',
    'LOGS'      => FILEROOT.'/logs/',
    'FILES'     => FILEROOT.'/files/',
    'DIC'       => FILEROOT.'/dic/'
];
if (!defined('PATHS')) {
    define('PATHS', $paths);
}
if (!defined('LOG_TYPES')) {
    define('LOG_TYPES', [
        'error'  => true,
        'user'   => true,
        'system' => true
    ]);
}
if (!defined('DEFAULT_SYSTEM_NAME')) {
    define('DEFAULT_SYSTEM_NAME', CLIENT_DATA['SOFTWARE']['SYSNAMEC']);
}
if (!defined('SYSTEM_OWNER')) {
    define('SYSTEM_OWNER', CLIENT_DATA['SOFTWARE']['SYSOWNER']);
}
if (!defined('SYSTEM_VERSION')) {
    define('SYSTEM_VERSION', CLIENT_DATA['SOFTWARE']['VERSION'].'.'.CLIENT_DATA['SOFTWARE']['BUILD']);
}
if (!defined('SYSTEM_AUTHOR')) {
    define('SYSTEM_AUTHOR', SYSTEM_OWNER.' '.DEFAULT_SYSTEM_NAME.' '.SYSTEM_VERSION);
}
if (!defined('SESSION_NAME')) {
    define('SESSION_NAME', DEFAULT_SYSTEM_NAME);
}
if (!defined('SESSION_BYHOUR')) {
    define('SESSION_BYHOUR', CONF_DATA['SETUP']['SESSION_BYHOUR']);
}
if (!defined('SESSION_TIME_OUT')) {
    define('SESSION_TIME_OUT', time() + SESSION_BYHOUR * 60 * 60);
}
if (!defined('SESSION_TIME_EXPIRE')) {
    define('SESSION_TIME_EXPIRE', time() + 3600);
}
if (!defined('DEFAULT_LINEBRAKE')) {
    define('DEFAULT_LINEBRAKE', '&#013;&#010;');
}
if (!defined('DEFAULT_PDF_PAGEBRAKE')) {
    define('DEFAULT_PDF_PAGEBRAKE', '<pagebreak />');
}
if (!defined('DEFAULT_NULLDATETIME')) {
    define('DEFAULT_NULLDATETIME', '0000-00-00 00:00:00');
}
if (!defined('DEFAULT_NULLDATE')) {
    define('DEFAULT_NULLDATE', '0000-00-00');
}
if (!defined('DEFAULT_NULLTIME')) {
    define('DEFAULT_NULLTIME', '00:00:00');
}
if (!defined('DEFAULT_NULL')) {
    define('DEFAULT_NULL', null);
}
if (!defined('DEFAULT_NULLDATETIME')) {
    define('DEFAULT_NULLDATETIME', '0000-00-00 00:00:00');
}
if (!defined('DEFAULT_NULLDATE')) {
    define('DEFAULT_NULLDATE', '0000-00-00');
}
if (!defined('DEFAULT_NULLTIME')) {
    define('DEFAULT_NULLTIME', '00:00:00');
}
if (!defined('MSG_INTERFACE')) {
    define('MSG_INTERFACE', 'The System is linked to Interface Data, some delay may occur at Start or End.'
    );
}
