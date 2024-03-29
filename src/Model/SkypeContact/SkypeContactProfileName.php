<?php

namespace Akbv\PhpSkype\Model\SkypeContact;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeContactProfileName extends \Akbv\PhpSkype\Model\Base
{
    /**
     * first
     * @var string
     */
    private $firstName;

    /**
     * surname
     * @var string
     */
    private $lastName;

    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $data['first'] = $this->firstName;
        $data['surname'] = $this->lastName;
        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->firstName = !empty($raw->first) ? $raw->first : null;
        $this->lastName = !empty($raw->surname) ? $raw->surname : null;

    }

    /**
     * Get first
     *
     * @return  string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set first
     *
     * @param  string  $firstName  first
     *
     * @return  self
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get surname
     *
     * @return  string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set surname
     *
     * @param  string  $lastName  surname
     *
     * @return  self
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
}
