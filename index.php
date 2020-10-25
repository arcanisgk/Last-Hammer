<?php

namespace IcarosNet\LastHammer;
if (!version_compare(phpversion(), '7.4', '>=')) {
    die(sprintf("This project requires PHP ver. %s or higher", '7.4'));
}

use IcarosNet\LastHammer\App\Core;

ob_start();
require_once 'Autoloader.php';
Autoloader::getInstance();
Core::getInstance()->goCoreApp();