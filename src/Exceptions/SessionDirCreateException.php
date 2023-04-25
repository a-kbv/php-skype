<?php

namespace Akbv\PhpSkype\Exceptions;

/**
 * Class SessionDirCreateException
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class SessionDirCreateException extends \Exception
{
    public const MESSAGE = 'Unable to create the directory %s.';

    public function __construct(string $dir)
    {
        parent::__construct(sprintf(self::MESSAGE, $dir));
    }
}
