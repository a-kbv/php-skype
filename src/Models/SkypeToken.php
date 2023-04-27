<?php

namespace Akbv\PhpSkype\Models;

/**
 * Property for class @see Session that holds data retrieved from Skype Token.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeToken extends Base
{
    /**
     * 424 chars string obtained from logging in skype account
     * @var string
     */
    private $skypeToken;
    /**
     * @var string
     */
    private $expiresIn;

    /**
     * @return string
     */
    public function getSkypeToken(): string
    {
        return $this->skypeToken;
    }

    /**
     * @param string $value
     */
    public function setSkypeToken(string $value): self
    {
        $this->skypeToken = $value;

        return $this;
    }

    /**
     * Get the value of expiresIn
     *
     * @return  string
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * Set the value of expiresIn
     *
     * @param  string  $expiresIn
     *
     * @return  self
     */
    public function setExpiresIn(string $expiresIn): self
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }
}
