<?php

namespace Akbv\PhpSkype\Exceptions;

/**
 * Class ClientSecurityTokenException
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class ClientSecurityTokenException extends \Exception
{
    public const MESSAGE = 'Unable to login to Microsoft [%s]';

    public function __construct(mixed $reason)
    {
        parent::__construct(sprintf(self::MESSAGE, $reason));
    }
}
