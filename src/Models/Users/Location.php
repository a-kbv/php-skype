<?php

namespace Akbv\PhpSkype\Models\Users;

/**
 * The location of a user or contact.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class Location extends \Akbv\PhpSkype\Models\User
{
    /**
     * Town or city where the user is located.
     * @var string
     */
    private $city;

    /**
     * home or work.
     * @var string
     */
    private $type;

    /**
     * Two-letter country code for their location.
     * @var string
     */
    private $country;

    /**
     * State or province where the user is located.
     * @var string
     */
    private $state;

    /**
     * Constructor.
     * @param mixed[] $raw raw data
     */
    public function __construct(array $raw)
    {
        $this->city = isset($raw['profile']['locations']['city']) ? $raw['profile']['locations']['city'] : null;
        $this->type = isset($raw['profile']['locations']['type']) ? $raw['profile']['locations']['type'] : null;
        $this->country = isset($raw['profile']['locations']['country']) ? $raw['profile']['locations']['country'] : null;
        $this->state = isset($raw['profile']['locations']['state']) ? $raw['profile']['locations']['state'] : null;
    }

    /**
     * Get town or city where the user is located.
     *
     * @return  string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get home or work.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get two-letter country code for their location.
     *
     * @return  string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get state or province where the user is located.
     *
     * @return  string
     */
    public function getState()
    {
        return $this->state;
    }
}
