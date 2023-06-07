<?php

namespace Akbv\PhpSkype\Utils;

/**
 * Manage Skype Message content.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class MessageProcessor
{
    public static function normalizeMessage(string $message): string
    {
        $message = str_replace("\r\n", "\n", $message);
        $message = str_replace("\r", "\n", $message);
        $message = str_replace("\n", "\r\n", $message);
        return $message;
    }
}
