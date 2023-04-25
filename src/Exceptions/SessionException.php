<?php

namespace Akbv\PhpSkype\Exceptions;

/**
 * Class SessionException
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class SessionException extends \Exception
{
    public const MESSAGE = 'Unable to login to Skype [%s]';

    public function __construct(mixed $reason)
    {
        parent::__construct(sprintf(self::MESSAGE, $reason));
    }
}
