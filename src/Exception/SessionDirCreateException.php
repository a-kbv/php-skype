<?php

namespace Akbv\PhpSkype\Exception;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
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
