<?php

namespace Akbv\PhpSkype\Models;

/**
 * Decorator for class @see Account that holds data related for cache.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Session extends Base
{
    /**
     * Session related Account.
     *
     * @var Account
     */
    private $account;

    /**
     * DateTime until the cache is valid.
     *
     * @var \DateTime|null
     */
    private $expiry;

    /**
     * @var SkypeToken|null
     */
    private $skypeToken;

    /**
     * @var RegistrationToken|null
     */
    private $registrationToken;

    /**
     * @var SecurityToken|null
     */
    private $securityToken;

    /**
     * @var Endpoint|null
     */
    private $endpoint;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
    * Check if @see Session is New.
    * @return bool
    */
    public function isNew()
    {
        $result = null === $this->expiry;
        return $result;
    }

    /**
     * Check if @see Session is expired.
     * @param \DateTime $now
     * @return bool
     */
    public function isExpired(\DateTime $now = null)
    {
        if (null === $now) {
            $now = new \DateTime();
        }
        $result = $now > $this->expiry;
        return $result;
    }

    /**
     * Reset @see Session attributes.
     */
    public function reset(): void
    {
        $this->expiry = null;
        $this->skypeToken = null;
        $this->registrationToken = null;
        $this->securityToken = null;
        $this->endpoint = null;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return \DateTime
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * @param \DateTime $expiry
     */
    public function setExpiry(\DateTime $expiry): self
    {
        $this->expiry = $expiry;

        return $this;
    }

    public function getSkypeToken(): ?SkypeToken
    {
        return $this->skypeToken;
    }

    public function setSkypeToken(SkypeToken $skypeToken): self
    {
        $this->skypeToken = $skypeToken;

        return $this;
    }

    /**
     * @return RegistrationToken
     */
    public function getRegistrationToken(): ?RegistrationToken
    {
        return $this->registrationToken;
    }

    /**
     * @param RegistrationToken $registrationToken
     */
    public function setRegistrationToken(RegistrationToken $registrationToken): self
    {
        $this->registrationToken = $registrationToken;

        return $this;
    }

    /**
     * @return SecurityToken
     */
    public function getSecurityToken()
    {
        return $this->securityToken;
    }

    /**
     * @param SecurityToken $securityToken
     */
    public function setSecurityToken(SecurityToken $securityToken): self
    {
        $this->securityToken = $securityToken;

        return $this;
    }

    /**
     * Get the value of endpoint
     */
    public function getEndpoint(): ?Endpoint
    {
        return $this->endpoint;
    }

    /**
     * Set the value of endpoint
     * @param  Endpoint|null $endpoint
     */
    public function setEndpoint($endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }
}
