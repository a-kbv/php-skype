<?php

namespace Akbv\PhpSkype\Exceptions;

/**
 * Class ClientSkypeTokenException
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class ClientSkypeTokenException extends \Exception
{
    public const MESSAGE = 'Unable to login to Skype [%s]';

    public function __construct(mixed $reason)
    {
        parent::__construct(sprintf(self::MESSAGE, $reason));
    }
}
