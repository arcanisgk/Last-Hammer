<?php
if (php_sapi_name() == "cli") {
	if(!isset($_SERVER["PWD"])){
		$path = dirname(__DIR__);
	}else{
		$path = dirname($_SERVER["PWD"]);
	}
	$inLine  = chr(27) . '[1;42m';
	$result  = chr(27) . '[1;0m';
	$outLine = chr(27) . '[0m' . PHP_EOL;
	$htmlS   = '';
	$htmlE   = '';
} else {
	if(!isset($_SERVER["DOCUMENT_ROOT"])){
		$path = dirname(__DIR__);
	}else{
		$path = $_SERVER["DOCUMENT_ROOT"];
	}
	$inLine  = '';
	$result  = '';
	$outLine = '<br>';
	$htmlS   = '<pre>';
	$htmlE   = '</pre>';
}
require_once $path . '/const/Constant.php';
echo $htmlS;
echo $inLine . '>>>>>>>>>>>>>>>>>Inicio de Ejecucion CRON<<<<<<<<<<<' . $outLine;
echo $inLine . '>>>>>>>>>>>>>>>>>>>>Area de Desarrollo<<<<<<<<<<<<<<' . $outLine;
echo $result . '>>>>>>>>>>>>>>>>>>>>>>>>Resultados<<<<<<<<<<<<<<<<<<' . $outLine;
$url      = 'http://' . DOMAIN . '/'; //Agregar la URL que desea usar
$fields   = ['jsonData' => json_encode([['idprocess' => 'c-cron-list'], ['idform' => 'c-cron-list'], ['dev_env' => true]])];
$postvars = http_build_query($fields);
$options  = [
	CURLOPT_URL            => $url,
	CURLOPT_POST           => count($fields),
	CURLOPT_POSTFIELDS     => $postvars,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FRESH_CONNECT  => true,
];
$ch = curl_init();
curl_setopt_array($ch, $options);
echo $result . curl_exec($ch) . $outLine;
curl_close($ch);
echo $inLine . '>>>>>>>>>>>>>>>>>>>>>FIN de Ejecucion<<<<<<<<<<<<<<<' . $outLine;
echo $htmlE;