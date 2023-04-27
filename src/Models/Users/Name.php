<?php

namespace Akbv\PhpSkype\Models\Users;

/**
 * The name of a user or contact.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Name extends \Akbv\PhpSkype\Models\User
{
    /**
     * First and middle names of the user.
     * @var string
     */
    private $first;

    /**
     * Surname of the user.
     * @var string
     */
    private $last;

    /**
     * Constructor.
     * @param mixed[] $raw raw data
     */
    public function __construct(array $raw)
    {
        $this->first = isset($raw['profile']['name']['first']) ? $raw['profile']['name']['first'] : null;
        $this->last = isset($raw['profile']['name']['last']) ? $raw['profile']['name']['last'] : null;
    }

    /**
     * Get full name of the user.
     *
     * @return  string
     */
    public function __toString()
    {
        return $this->first . ' ' . $this->last;
    }

    /**
     * Get first and middle names of the user.
     *
     * @return  string
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * Set first and middle names of the user.
     *
     * @param  string  $first  First and middle names of the user.
     *
     * @return  self
     */
    public function setFirst(string $first)
    {
        $this->first = $first;

        return $this;
    }

    /**
     * Get surname of the user.
     *
     * @return  string
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * Set surname of the user.
     *
     * @param  string  $last  Surname of the user.
     *
     * @return  self
     */
    public function setLast(string $last)
    {
        $this->last = $last;

        return $this;
    }
}
