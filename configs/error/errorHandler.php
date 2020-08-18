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
set_exception_handler("ExceptionHandler");
set_error_handler("ErrorHandler");
function ShutdownHandler()
{
    $error = error_get_last();
    if (null != $error) {
        ob_end_clean();
        flush();
        $errorcron         = false;
        $errorserv         = false;
        $errortype         = 'ShutdownHandler';
        $errorfile         = $error['file'];
        $errorline         = $error['line'];
        $errordesc         = $error['message'];
        $errorbacktrace    = '';
        $errorbacktracecli = [0 => '  Backtrace data:'];
        $tracedata         = array_reverse(debug_backtrace());
        array_pop($tracedata);
        if (!empty($tracedata)) {
            foreach ($tracedata as $item) {
                $errorbacktrace .= '  '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()'."<br>";
                $errorbacktracecli[] = '    '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()';
            }
        } else {
            $errorbacktracecli = [0 => '    No backtrace data in the error.'];
            $errorbacktrace    = 'No backtrace data in the error.';
        }
        $errorcron = (php_sapi_name() == 'cli' ? true : false);
        if (isset($_POST['form']) && false == $errorcron) {
            $postarr = explode('-', $_POST['form']);
            if ('c' === $postarr[0]) {
                $errorcron = true;
            }
            if ('ws' === $postarr[0]) {
                $errorserv = true;
            }
        }
        if (true == $errorcron) {
            echo
            PHP_EOL.AnsiColorView('warning', ' ShutdownHandler ').PHP_EOL.
            PHP_EOL.AnsiColorView('normal', ' File: '.$errorfile).
            PHP_EOL.AnsiColorView('normal', ' Line : '.$errorline).
            PHP_EOL.AnsiColorView('normal', ' Description:').
            PHP_EOL.AnsiColorView('normal', '  '.$errordesc).PHP_EOL;
            foreach ($errorbacktracecli as $key => $value) {
                echo AnsiColorView('backtr', $value).PHP_EOL;
            }
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
    $errorcron         = false;
    $errorserv         = false;
    $errortype         = 'ErrorHandler';
    $errorfile         = $error_file;
    $errorline         = $error_line;
    $errordesc         = $error_message;
    $errorbacktrace    = '';
    $errorbacktracecli = [0 => '  Backtrace data:'];
    $tracedata         = array_reverse(debug_backtrace());
    array_pop($tracedata);
    if (!empty($tracedata)) {
        foreach ($tracedata as $item) {
            $errorbacktrace .= ' '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()'."<br>";
            $errorbacktracecli[] = '    '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()';
        }
    } else {
        $errorbacktracecli = [0 => '    No backtrace data in the error.'];
        $errorbacktrace    = 'No backtrace data in the error.';
    }
    $errorcron = (php_sapi_name() == 'cli' ? true : false);
    if (isset($_POST['form']) && false == $errorcron) {
        $postarr = explode('-', $_POST['form']);
        if ('c' === $postarr[0]) {
            $errorcron = true;
        }
        if ('ws' === $postarr[0]) {
            $errorserv = true;
        }
    }
    if (true == $errorcron) {
        echo
        PHP_EOL.AnsiColorView('warning', ' ErrorHandler ').PHP_EOL.
        PHP_EOL.AnsiColorView('normal', ' File: '.$errorfile).
        PHP_EOL.AnsiColorView('normal', ' Line : '.$errorline).
        PHP_EOL.AnsiColorView('normal', ' Description:').
        PHP_EOL.AnsiColorView('normal', '  '.$errordesc).PHP_EOL;
        foreach ($errorbacktracecli as $key => $value) {
            echo AnsiColorView('backtr', $value).PHP_EOL;
        }
    } elseif (true == $errorserv) {
        header('Content-type: application/json');
        echo json_encode(['error' => ['type' => 'ErrorHandler', 'file' => $errorfile, 'line' => $errorline, 'description' => $errordesc]]);
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'].'/html/status/php_error.php';
    }
    error_clear_last();
    exit();
}
function ExceptionHandler($e)
{
    ob_end_clean();
    flush();
    $errorcron         = false;
    $errorserv         = false;
    $errorsys          = false;
    $errortype         = 'ExceptionHandler';
    $errorfile         = $e->getFile();
    $errorline         = $e->getLine();
    $errordesc         = $e->getMessage();
    $errorbacktrace    = '';
    $errorbacktracecli = [0 => '  Backtrace data:'];
    $tracedata         = array_reverse($e->getTrace());
    array_pop($tracedata);
    $data = 'no data';
    if (!empty($tracedata)) {
        foreach ($tracedata as $item) {
            $errorbacktrace .= ' '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()'."<br>";
            $errorbacktracecli[] = '    '.(isset($item['file']) ? $item['file'] : '<unknown file>').' '.(isset($item['line']) ? $item['line'] : '<unknown line>').' calling '.$item['function'].'()';
        }
    } else {
        $errorbacktracecli = [0 => 'No backtrace data in the error.'];
        $errorbacktrace    = '    No backtrace data in the error.';
    }
    #echo var_dump($tracedata, $errorbacktracecli);
    #die;
    $errorcron = (php_sapi_name() == 'cli' ? true : false);
    if (isset($_POST['form']) && false == $errorcron) {
        $postarr = explode('-', $_POST['form']);
        if ('c' === $postarr[0]) {
            $errorcron = true;
        }
        if ('ws' === $postarr[0]) {
            $errorserv = true;
        }
    }
    if (isset($_POST['jsonData']) && false == $errorcron && false == $errorserv) {
        $errorcron = checkjson($_POST['jsonData']);
    }
    $any_header = headers_sent();
    if (true == $errorcron) {
        $backtrace = '';
        foreach ($errorbacktracecli as $key => $value) {
            $backtrace .= PHP_EOL.AnsiColorView('backtr', $value);
        }
        echo
        PHP_EOL.AnsiColorView('warning', ' ExceptionHandler ').PHP_EOL.
        PHP_EOL.AnsiColorView('normal', ' File: '.$errorfile).
        PHP_EOL.AnsiColorView('normal', ' Line : '.$errorline).
        PHP_EOL.AnsiColorView('normal', ' Description:').
        PHP_EOL.AnsiColorView('normal', '  '.$errordesc).$backtrace;

    } elseif (true == $errorserv) {
        if (!$any_header) {
            header('Content-type: application/json');
        }
        echo json_encode(['error' => ['type' => 'ExceptionHandler', 'file' => $errorfile, 'line' => $errorline, 'description' => $errordesc]]);
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'].'/html/status/php_error.php';
    }
    error_clear_last();
    exit();
}

function AnsiColorView($type, $text, $reset = true)
{
    $warning = chr(27).'[1;41m';
    $normal  = chr(27).'[1;96m';
    $backtr  = chr(27).'[1;90m';
    $eol     = chr(27).'[0m';
    $res     = chr(27).'[1;32m';
    $text    = ${$type}.$text.$eol.($reset ? $res : '');
    return $text;
}
function checkjson($data)
{
    $result = false;
    $result = array_map(function ($el) {
        if (isset($el['form'])) {
            $elarr = explode('-', $el['form']);
            if ('c' === $elarr[0] || 'w' === $elarr[0]) {
                return true;
            }
        }
    }, json_decode($data, true));
    return $result;
}
