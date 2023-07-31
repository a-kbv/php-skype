<?php

namespace Akbv\PhpSkype\Exception;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class AuthenticationSkypeTokenException extends \Exception
{
    public const MESSAGE = 'Unable to login to Microsoft [%s]';

    public function __construct(mixed $reason)
    {
        parent::__construct(sprintf(self::MESSAGE, $reason));
    }
}
