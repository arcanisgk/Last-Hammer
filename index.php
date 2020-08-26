<?php

$requiredVersion = '7.2';
if (!version_compare(phpversion(), $requiredVersion, '>=')) {
    die(sprintf("This project requires PHP ver. %s or higher", $requiredVersion));
}

use IcarosNet\LastHammer\CoreApp;

require_once 'configs/const/loader.php';
require_once 'app/autoloader.php';

ob_start();
CoreApp::getInstance()->goCoreApp();