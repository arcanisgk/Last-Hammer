<?php

use IcarosNet\LastHammer\CoreApp;

require_once 'configs/const/loader.php';
require_once 'apps/core/autoloader.php';

ob_start();
CoreApp::_getInstance()->goCoreApp();

