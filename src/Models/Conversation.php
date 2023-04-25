<?php

namespace Akbv\PhpSkype\Models;

/**
 * Skype conversation can be used for account or group interactions with another account.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class Conversation extends Base
{
    /**
     * Skype Name of User or Group.
     *
     * @var string
     */
    private $name;

    /**
     * First Name and Last Name for User and Group Name fro group.
     *
     * @var string
     */
    private $label;

    public function __construct(string $name, string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * User or Group mode.
     * @return int
     */
    public function getMode(): int
    {
        $mode = strstr($this->name, '@thread.skype') ? 19 : 8;
        return $mode;
    }
}
