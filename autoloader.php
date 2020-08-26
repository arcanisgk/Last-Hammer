<?php
define('BASE_PATH', realpath(dirname(__FILE__)));
function my_autoloader($class)
{

    $parts = explode('\\', $class);

    $partsGiven = count($parts);
    if ($partsGiven < 3) {
        throw new Exception(sprintf("This autoloder supports minimum 3 parts in namespace, %s given", $partsGiven), time());
    }
    unset($parts[0]);
    unset($parts[1]);
    $filename = BASE_PATH . '/apps/Classes/' . implode('/', $parts) . '.php';
    require_once($filename);
}

spl_autoload_register('my_autoloader');

//die('autodie');