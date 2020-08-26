<?php

# ! Warning do not change DBDEFAULT_NAME, DBSOFT_NAME, DBSOFT_SUBSYSTEM

use IcarosNet\LastHammer\CoreApp;

CoreApp::$ovars['SYS']['CONF'] = [
    'SOFTWARE' => [
        'SOFT_VERSION'     => '1.0',
        'HOST_LICENSE'     => '',
        'HOST_KEY'         => '',
        'DBDEFAULT_HOST'   => '127.0.0.1',
        'DBDEFAULT_PORT'   => '3306',
        'DBDEFAULT_NAME'   => 'lasthammer',
        'DBDEFAULT_USER'   => 'root',
        'DBDEFAULT_PASS'   => '123456',
        'DBSOFT_NAME'      => 'last_hammer',
        'DBSOFT_SUBSYSTEM' => 'lh_subsystem',
        'DBSOFT_USER'      => 'root',
        'DBSOFT_PASS'      => '123456',
        'USADMIN_NAME'     => 'admin',
        'USADMIN_PASS'     => 'admin'
    ]
];
