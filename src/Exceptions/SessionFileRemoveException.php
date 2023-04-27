<?php

namespace Akbv\PhpSkype\Exceptions;

/**
 * Class SessionFileRemoveException
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
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
