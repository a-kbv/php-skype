<?php

namespace Akbv\PhpSkype\Exceptions;

/**
 * Class SessionFileRemoveException
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class SessionFileRemoveException extends \Exception
{
    public const MESSAGE = 'Unable to remove the file %s.';

    public function __construct(string $path)
    {
        parent::__construct(sprintf(self::MESSAGE, $path));
    }
}
