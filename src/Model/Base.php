<?php

namespace Akbv\PhpSkype\Model;

use JsonSerializable;

abstract class Base implements JsonSerializable
{
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    abstract public function toArray();
}
