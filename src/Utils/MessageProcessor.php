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
        $message = preg_replace('/<[^>]*>/', '', $message); // Remove tags
        $message = preg_replace('/&[^;]*;/', '', $message); // Remove symbols
        $message = mb_convert_encoding($message, 'UTF-8', 'UTF-8'); // Ensure UTF-8 encoding
        $message = json_decode('"' . $message . '"'); // Fix Cyrillic Unicode characters
        if (empty($message)) {
            return 'failed to parse message';
        }
        return $message;
    }
}
