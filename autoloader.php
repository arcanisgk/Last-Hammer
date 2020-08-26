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
//    print_r($parts);
//    die();

//    $partsx = str_replace('\\', '/', $class);

    $filename = BASE_PATH . '/apps/Classes/' . implode('/', $parts) . '.php';
// /www/githubprojects.loc/Last-Hammer/apps/Classes/IcarosNet/LastHammer/Gen/Date.php
// /www/githubprojects.loc/Last-Hammer/apps/Classes/IcarosNet/LastHammer/Gen/Date.php
    require_once($filename);
//    die($filename);
}

spl_autoload_register('my_autoloader');

//die('autodie');