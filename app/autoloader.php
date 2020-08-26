<?php

// you can define only one of!
//define('BASE_PATH', realpath(dirname(__DIR__, 2))); // Use this if you move autoloader 2 directories deeper from index.php
define('BASE_PATH', realpath(dirname(__DIR__, 1))); // Use this if you move autoloader 1 directory deeper from index.php
//define('BASE_PATH', realpath(dirname(__FILE__))); // use this if on the same level as index.php

function last_hammer_autoloader($class)
{
    $parts = explode('\\', $class);
    $partsGiven = count($parts);
    if ($partsGiven < 3) {
        throw new Exception(sprintf("This autoloder supports minimum 3 parts in namespace, %s given", $partsGiven), time());
    }
    unset($parts[0]);
    unset($parts[1]);
    $filename = BASE_PATH . '/app/src/' . implode('/', $parts) . '.php';
    /** @noinspection PhpIncludeInspection */
    require_once($filename);
}

spl_autoload_register('last_hammer_autoloader');