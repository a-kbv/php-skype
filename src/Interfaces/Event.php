<?php

namespace Akbv\PhpSkype\Interfaces;

/**
 * Interface Event.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
interface Event
{
    public function getType(): string;
}
