<?php

if (php_sapi_name() == "cli") {
	if(!isset($_SERVER["PWD"])){
		$path = dirname(__DIR__);
	}else{
		$path = dirname($_SERVER["PWD"]);
	}
	$inLine  = chr(27) . '[1;42m';
	$result  = chr(27) . '[1;0m';
	$danger  = chr(27) . '[1;41m';
	$outLine = chr(27) . '[0m' . PHP_EOL;
	$htmlS   = '';
	$htmlE   = '';
} else {
	if(!isset($_SERVER["DOCUMENT_ROOT"])){
		$path = dirname(__DIR__);
	}else{
		$path = $_SERVER["DOCUMENT_ROOT"];
	}
	$inLine  = '<span style="background-color:green; color:white">';
	$result  = '<span style="background-color:white; color:black">';
	$danger  = '<span style="background-color:red; color:white">';
	$outLine = '</span><br>';
	$htmlS   = '<pre>';
	$htmlE   = '</pre>';
}
require_once $path . '/const/Constant.php';
echo $htmlS;
echo $inLine . '>>>>>>>>>>>>>>>>>Inicio de Ejecucion SERV<<<<<<<<<<<' . $outLine;
echo $inLine . '>>>>>>>>>>>>>>>>>>>>Area de Desarrollo<<<<<<<<<<<<<<' . $outLine;
echo $result . '>>>>>>>>>>>>>>>>>>>>>>>>Resultados<<<<<<<<<<<<<<<<<<' . $outLine;
$url      = 'http://' . DOMAIN . '/'; //Agregar la URL que desea usar
$fields   = ['jsonData' => json_encode([['idprocess' => 'ws-serv-list'], ['idform' => 'ws-serv-list'], ['dev_env' => true]])];
$postvars = http_build_query($fields);
$options  = [
	CURLOPT_URL            => $url,
	CURLOPT_POST           => count($fields),
	CURLOPT_POSTFIELDS     => $postvars,
	CURLOPT_TIMEOUT        => 20,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CONNECTTIMEOUT => 20,
	CURLOPT_FRESH_CONNECT  => true,
	CURLOPT_HEADER         => true,
];
$ch = curl_init();
curl_setopt_array($ch, $options);
$Data = curl_exec($ch);
$Body = substr($Data, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
/* no funciono esta opcion
preg_match('~^Content-Type: \K.+~m', $Data, $match) ? $head = $match[0] : $head = false;
 */
$headers   = $Data;
$headerARR = array_filter(explode(PHP_EOL, substr($headers, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE))));
$head      = '';
foreach ($headerARR as $line) {
	$leed = explode(':', $line);
	if (strpos($leed[0], "Content-Type") !== false) {
		$head = str_replace(' ', '', $leed[1]);
		$head = trim(strip_tags($head));
	}
}
if ((strcmp($head,'application/json') === 0) AND (!is_array($Body)) AND (json_decode($Body) != null) AND $Body != false) {
	$Body = json_decode($Body);
} else {
	echo $danger . '>>>>>>>Cuidado la Respuesta no es Formato JSON<<<<<<' . $outLine . PHP_EOL . PHP_EOL;
	echo $danger . 'Head:' . $head . '' . $outLine . PHP_EOL . PHP_EOL;
}
if (isset($Body->error)) {
	echo PHP_EOL . PHP_EOL . $danger . 'Tipo: ' . $Body->error->type . $outLine . $danger . 'Archivo: ' . $Body->error->file . $outLine . $danger . 'Linea: ' . $Body->error->line . $outLine . $danger . 'Descripcion: ' . $Body->error->description . $outLine . PHP_EOL . PHP_EOL;
} else {
	echo PHP_EOL . PHP_EOL . $result . var_export($Body) . $outLine . PHP_EOL;
}
curl_close($ch);
echo $inLine . '>>>>>>>>>>>>>>>>>>>>>FIN de Ejecucion<<<<<<<<<<<<<<<' . $outLine;
echo $htmlE;