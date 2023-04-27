<?php

namespace Akbv\PhpSkype\Utils;

use Akbv\PhpSkype\Exceptions\ClientException;

/**
 * Manage debugging.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class DebugUtil
{
    /**
     * Log the execution step (in any format) to a debugging file.
     *
     * @param string $message The message to log.
     * @param mixed $context The context to log, can be any type.
     * @param mixed $severity The severity of the message.
     * @return void
     */
    public static function log($message, $context, $severity = \Monolog\Logger::WARNING): void
    {
        // If the debug mode is not enabled, do not log anything.
        if (!\Akbv\PhpSkype\Utils\EnvUtil::isDebug()) {
            return;
        }
        if (empty($context)) {
            $context = [];
        }
        if (empty($message)) {
            $message = '';
        }
        if (is_string($context) || is_int($context)) {
            $context = ['context' => $context];
        }
        // Check if context is an object and has a method called mapPropertiesToArray()
        if (is_object($context) && method_exists($context, 'mapPropertiesToArray')) {
            $context = $context->mapPropertiesToArray();
        }

        $logger = new \Monolog\Logger('PhpSkype');
        $handler = new \Monolog\Handler\RotatingFileHandler('logs/debug/debug.log', 0, \Monolog\Logger::DEBUG);
        $handler->setFilenameFormat('{date}', 'Y/m/d');
        $logger->pushHandler($handler);

        $logger->log($severity, $message, $context);
    }
}
