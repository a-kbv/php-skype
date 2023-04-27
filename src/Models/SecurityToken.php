<?php

namespace Akbv\PhpSkype\Models;

use Symfony\Component\HttpFoundation\Cookie;

/**
 * Property for class @see Session that holds data retrieved from Microsoft.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SecurityToken extends Base
{
    /**
     * @var string
     */
    private $token;


    /**
     * Get the value of token
     *
     * @return  string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @param  string  $token
     *
     * @return  self
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
