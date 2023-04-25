<?php

namespace Akbv\PhpSkype\Exceptions;

/**
 * Class SessionFileLoadException
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class SessionFileLoadException extends \Exception
{
    public const MESSAGE = 'Unable to load the file %s.';

    public function __construct(string $path)
    {
        parent::__construct(sprintf(self::MESSAGE, $path));
    }
}
