<?php

namespace Akbv\PhpSkype\Model\Storage;

abstract class AbstractStorage
{
    abstract public function save(array $sessionData): void;
    abstract public function load(string $username): ?array;
    abstract public function delete(string $username): void;
}
