<?php

namespace Akbv\PhpSkype\Exception;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SessionFileSaveException extends \Exception
{
    public const MESSAGE = 'Unable to save the file %s.';

    public function __construct(string $path)
    {
        parent::__construct(sprintf(self::MESSAGE, $path));
    }
}
