<?php

namespace Akbv\PhpSkype\Models\Users;

/**
 * The Phone of a user or contact.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Phone extends \Akbv\PhpSkype\Models\User
{

    /**
     * The phone number for this user.
     * @var string
     */
    private $number;

    /**
     * The type of the phone number for this user.
     * @var string
     */
    private $type;

    /**
     * Constructor.
     * @param mixed[] $data raw data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }


    /**
     * Get the phone number for this user.
     *
     * @return  string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the phone number for this user.
     *
     * @param  string  $number  The phone number for this user.
     *
     * @return  self
     */
    public function setNumber(string $number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the type of the phone number for this user.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type of the phone number for this user.
     *
     * @param  string  $type  The type of the phone number for this user.
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }
}
