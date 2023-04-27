<?php

namespace Akbv\PhpSkype\Utils;

use Akbv\PhpSkype\Exceptions\ClientException;

/**
 * Manage environment variables.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class EnvUtil
{
    /**
     * Get secret.
     * @return string
     * @throws ClientException
     */
    public static function getSecret(): string
    {
        if (!($secret = $_ENV['SESSION_SECRET'])) {
            throw new ClientException('Should be specified SESSION_SECRET env var.');
        }
        return $secret;
    }
    /**
     * Get email.
     * @return string
     * @throws ClientException
     */
    public static function getEmail(): string
    {
        if (!($secret = $_ENV['SKYPE_LOGIN'])) {
            throw new ClientException('Should be specified SKYPE_LOGIN env var.');
        }
        return $secret;
    }
    /**
     * Get password.
     * @return string
     * @throws ClientException
     */
    public static function getPassword(): string
    {
        if (!($secret = $_ENV['SKYPE_PASSWORD'])) {
            throw new ClientException('Should be specified SKYPE_PASSWORD env var.');
        }
        return $secret;
    }

    /**
    * Is debug mode or not.
    * @return bool
    */
    public static function isDebug(): bool
    {
        if (!isset($_ENV['DEBUG'])) {
            return false;
        }
        return $_ENV['DEBUG'] == 1;
    }
}
