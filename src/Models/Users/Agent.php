<?php

namespace Akbv\PhpSkype\Models\Users;

/**
 * The Agent of a user or contact.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Agent extends \Akbv\PhpSkype\Models\User
{
    /**
     * The capabilities for this user.
     * @var string[]
     */
    private $capabilities;

    /**
     * Constructor.
     * @param mixed[] $data raw data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }


    /**
     * Get the capabilities for this user.
     *
     * @return  string[]
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * Set the capabilities for this user.
     *
     * @param  string[]  $capabilities  The capabilities for this user.
     *
     * @return  self
     */
    public function setCapabilities(array $capabilities)
    {
        $this->capabilities = $capabilities;

        return $this;
    }
}
