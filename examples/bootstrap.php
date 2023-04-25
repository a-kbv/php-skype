<?php

require_once __DIR__ . '/../vendor/autoload.php';

//env handler
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

if (\Akbv\PhpSkype\Utils\EnvUtil::isDebug())
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    //monolog
    $log = new \Monolog\Logger('PhpSkypeErrors');
    $handler = new \Monolog\Handler\RotatingFileHandler('logs/error/debug.log', 0, \Monolog\Logger::DEBUG);
    $handler->setFilenameFormat('{date}', 'Y/m/d');
    $log->pushHandler($handler);

    //error handling
    set_error_handler("errorHandler");
    register_shutdown_function('fatalHandler');
}

function errorHandler($errNo, $errStr, $errFile, $errLine)
{
    global $log;

    switch ($errNo) {
        case E_WARNING:
        case E_USER_WARNING:
        case E_RECOVERABLE_ERROR:
            $log->warning("$errStr in $errFile:$errLine");
            break;

        case E_NOTICE:
        case E_USER_NOTICE:
            $log->notice("$errStr in $errFile:$errLine");
            break;

        case E_STRICT:
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
            $log->debug("$errStr in $errFile:$errLine");
            break;

        default:
            $log->error("$errStr in $errFile:$errLine");
            break;
    }
}

function fatalHandler()
{
    $errNo = E_CORE_ERROR;
    $errStr = "shutdown";
    $errFile = "unknown file";
    $errLine = 0;

    $error = error_get_last();
    if ($error !== null) {
        $errNo = $error["type"];
        $errStr = $error["message"];
        $errFile = $error["file"];
        $errLine = $error["line"];
        errorHandler($errNo, $errStr, $errFile, $errLine);

        if (!in_array($errNo, [E_WARNING, E_NOTICE, E_STRICT, E_DEPRECATED])) {
            http_response_code(500);
        }
    }
}

