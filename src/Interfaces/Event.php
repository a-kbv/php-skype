<?php

namespace Akbv\PhpSkype\Interfaces;

/**
 * Interface Event.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
interface Event
{
    public function getType(): string;
}
