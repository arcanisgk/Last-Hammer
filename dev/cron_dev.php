<?php
$path = (!isset($_SERVER["PWD"]) ? dirname(__DIR__).'\\' : dirname($_SERVER["PWD"]));
if (!defined('FILEROOT_MASTER')) {
    define('FILEROOT_MASTER', $path);
}
require_once FILEROOT_MASTER.'/configs/const/loader.php';
require_once $path.'/apps/class/gen/class-drawbox.php';
$exc_cron = (isset($argv[1]) ? $argv[1] : 'c-cron-list');
$header   = "Inicio de Ejecucion CRON
Area de Desarrollo
Resultados";
$footer   = "FIN de Ejecucion";
$url      = 'http://'.DOMAIN.'/'; //Agregar la URL que desea usar
$fields   = ['jsonData' => json_encode([['process' => $exc_cron], ['form' => $exc_cron], ['dev_env' => true]])];
$postvars = http_build_query($fields);
$options  = [
    CURLOPT_URL            => $url,
    CURLOPT_POST           => count($fields),
    CURLOPT_POSTFIELDS     => $postvars,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FRESH_CONNECT  => true
];
$ch = curl_init();
curl_setopt_array($ch, $options);
$rcurl = curl_exec($ch);
$box   = new ClassDrawboxManager();
echo $box->drawBoxes($header.PHP_EOL.$rcurl.PHP_EOL.$footer, 3, 1, true, 0);
curl_close($ch);
echo PHP_EOL;
