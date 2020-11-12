<?php

namespace IcarosNet\LastHammer;

use IcarosNet\LastHammer\App\Core\Core;

if (!version_compare(phpversion(), '7.4', '>=')) {
    die(sprintf("This project requires PHP ver. %s or higher", '7.4'));
}

ob_start();
require_once 'Autoloader.php';
Autoloader::getInstance();

//Core::getInstance()->goCoreApp();