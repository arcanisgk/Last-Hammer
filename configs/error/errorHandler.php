<?php
declare (strict_types = 1);
ini_set('session.gc_maxlifetime', '0');
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_httponly', '1');
ini_set('allow_url_fopen', '1');
ini_set('allow_url_include', '1');
ini_set('error_reporting', '1');
ini_set('display_errors', '0');
error_reporting(E_ALL);
register_shutdown_function("ShutdownHandler");
set_exception_handler("ExeptionHandler");
set_error_handler("ErrorHandler");
function ShutdownHandler()
{
    $error = error_get_last();
    if (null != $error) {
        ob_end_clean();
        flush();
        $errorcron      = false;
        $errorserv      = false;
        $errortype      = 'ShutdownHandler';
        $errorfile      = $error['file'];
        $errorline      = $error['line'];
        $errordesc      = $error['message'];
        $errorbacktrace = '';
        $tracedata      = array_reverse(debug_backtrace());

        array_pop($tracedata);
        if (!empty($tracedata)) {
            foreach ($tracedata as $item) {
                $errorbacktrace .= '  '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()'."<br>";
            }
        } else {
            $errorbacktrace = 'No backtrace data in the error.';
        }
        if (isset($_POST['idform'])) {
            $postarr = explode('-', $_POST['idform']);
            if ('c' === $postarr[0]) {
                $errorcron = true;
            }
            if ('ws' === $postarr[0]) {
                $errorserv = true;
            }
        }
        if (true == $errorcron) {
            echo PHP_EOL.PHP_EOL.chr(27).'[1;41m'.'ShutdownHandler: '.chr(27).'[0m'.PHP_EOL.PHP_EOL.chr(27).'[1;41m'.' File: '.$errorfile.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' Line : '.$errorline.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' Description:'.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' '.$errordesc.chr(27).'[0m'.PHP_EOL.PHP_EOL;
        } elseif (true == $errorserv) {
            header('Content-type: application/json');
            echo json_encode(['error' => ['type' => 'ShutdownHandler', 'file' => $errorfile, 'line' => $errorline, 'description' => $errordesc]]);
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'].'/html/status/php_error.php';
        }
        error_clear_last();
        exit();
    }
}
function ErrorHandler($error_level, $error_message, $error_file, $error_line, $error_context)
{
    ob_end_clean();
    flush();
    $errorcron      = false;
    $errorserv      = false;
    $errortype      = 'ErrorHandler';
    $errorfile      = $error_file;
    $errorline      = $error_line;
    $errordesc      = $error_message;
    $errorbacktrace = '';
    $tracedata      = array_reverse(debug_backtrace());
    array_pop($tracedata);
    if (!empty($tracedata)) {
        foreach ($tracedata as $item) {
            $errorbacktrace .= '  '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()'."<br>";
        }
    } else {
        $errorbacktrace = 'No backtrace data in the error.';
    }
    if (isset($_POST['idform'])) {
        $postarr = explode('-', $_POST['idform']);
        if ('c' === $postarr[0]) {
            $errorcron = true;
        }
        if ('ws' === $postarr[0]) {
            $errorserv = true;
        }
    }
    if (true == $errorcron) {
        echo PHP_EOL.PHP_EOL.chr(27).'[1;41m'.'ErrorHandler: '.chr(27).'[0m'.PHP_EOL.PHP_EOL.chr(27).'[1;41m'.' File: '.$errorfile.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' Line : '.$errorline.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' Description:'.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' '.$errordesc.chr(27).'[0m'.PHP_EOL.PHP_EOL;
    } elseif (true == $errorserv) {
        header('Content-type: application/json');
        echo json_encode(['error' => ['type' => 'ErrorHandler', 'file' => $errorfile, 'line' => $errorline, 'description' => $errordesc]]);
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'].'/html/status/php_error.php';
    }
    error_clear_last();
    exit();
}
function ExeptionHandler($e)
{
    ob_end_clean();
    flush();
    $errorcron      = false;
    $errorserv      = false;
    $errortype      = 'ExeptionHandler';
    $errorfile      = $e->getFile();
    $errorline      = $e->getLine();
    $errordesc      = $e->getMessage();
    $errorbacktrace = '';
    $tracedata      = array_reverse(debug_backtrace());
    array_pop($tracedata);
    if (!empty($tracedata)) {
        foreach ($tracedata as $item) {
            $errorbacktrace .= ' '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()'."<br>";
        }
    } else {
        $errorbacktrace = 'No backtrace data in the error.';
    }
    if (isset($_POST['idform'])) {
        $postarr = explode('-', $_POST['idform']);
        if ('c' === $postarr[0]) {
            $errorcron = true;
        }
        if ('ws' === $postarr[0]) {
            $errorserv = true;
        }
    }
    if (true == $errorcron) {
        echo PHP_EOL.PHP_EOL.chr(27).'[1;41m'.'ExeptionHandler: '.chr(27).'[0m'.PHP_EOL.PHP_EOL.chr(27).'[1;41m'.' File: '.$errorfile.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' Line : '.$errorline.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' Description:'.chr(27).'[0m'.PHP_EOL.chr(27).'[1;41m'.' '.$errordesc.chr(27).'[0m'.PHP_EOL.PHP_EOL;
    } elseif (true == $errorserv) {
        header('Content-type: application/json');
        echo json_encode(['error' => ['type' => 'ExeptionHandler', 'file' => $errorfile, 'line' => $errorline, 'description' => $errordesc]]);
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'].'/html/status/php_error.php';
    }
    error_clear_last();
    exit();
}
